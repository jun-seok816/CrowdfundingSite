<?php 
try{
    require 'dbInfo.php';
    include 'isSession.php';

    // 첨부파일 temp 변수에 담기
    function SaveTempFile($file){
        if( isset($file) ) { 
            if ( !($file['error'] > 0) ) {
                // return [0] : name, [1] : temp_name
                return array($file['name'], $file['tmp_name']);
            }
        }
    }

    // 프로젝트 등록 회원
    $register_id = $_SESSION['userId'];

    // ** insert project
    // 프로젝트명
    $pName = $_REQUEST["pName"]; 
    // 목표 펀딩금액
    $donateLimit = $_REQUEST["donateLimit"]; 
    // 펀딩 기간
    $dateLimit = $_REQUEST["dateLimit"]; 
    // 게임 스토리라인
    $storyline = $_REQUEST["storyline"]; 
    // 게임 플롯
    $summary = $_REQUEST["summary"]; 
    // 은행
    $etpBank = $_REQUEST["etpBank"]; 
    // 계좌번호 앞 자리
    $etpAccount1 = $_REQUEST["etpAccount1"]; 
    // 계좌번호 뒷 자리
    // $etpAccount2 = $_REQUEST["etpAccount2"]; 
    // 계좌번호(값 가공)
    // $f_cardnum = $etpAccount1.$etpAccount2; 
    $f_cardnum = $etpAccount1; 
    // 주당가격
    $etpPerValue = $_REQUEST["etpPerValue"]; 

    // ** insert category
    // 프로젝트 카테고리
    $pCategory = $_REQUEST["pCategory"]; 

    
    // ** insert img
    // 썸네일사진
    $temp_thumnail = SaveTempFile($_FILES['img_thumnail']); 
    // 썸네일 빅_대표사진
    $temp_thumnailBig = SaveTempFile($_FILES['img_thumnailBig']); 
    // 스토리라인사진
    $temp_storyline = SaveTempFile($_FILES['img_storyline']); 
    // 플롯(줄거리)사진
    $temp_summary = SaveTempFile($_FILES['img_summary']); 
    // 트레일러 링크
    $trailer = $_REQUEST["trailer"];

    // ** insert enterprise
    // 기업 이름
    $etpName = $_REQUEST["etpName"]; 
    // 기업 설명
    $etpDesc = $_REQUEST["etpDesc"]; 
    // 기업 로고
    $temp_logo = SaveTempFile($_FILES['img_logo']); 
    // 기업 URL
    $etpURL = $_REQUEST["etpURL"]; 
    // 기업 가치
    $etpValue = $_REQUEST["etpValue"]; 
    // IR 자료
    $temp_IR = SaveTempFile($_FILES['projectIR']); 

    // ** insert reward
    // 후원금액 (f_money)
    $re_money = [];
    // 보상단계 (f_div)
    $re_div = [];
    // 보상타이틀 (f_content)
    $re_content = [];
    // 보상설명 (f_descript)
    $re_descript = [];

    for($i=0; $i<sizeof($_REQUEST["re_money"]); $i++){
        $re_money[$i]    = $_REQUEST["re_money"][$i];
        $re_div[$i]      = $_REQUEST["re_div"][$i];
        $re_content[$i]  = $_REQUEST["re_content"][$i];
        $re_descript[$i] = $_REQUEST["re_descript"][$i];
    }

    function UploadLocalFile($fileArray, $fileType){
        // 전역변수
        global $pName;
        global $dirPath;
        // explode() : "."을 기점으로 문자열을 잘라 배열로 저장
        $temp = explode(".", $fileArray[0]); 
        // end()는 배열의 마지막 값을 가져옴.
        $extension = end($temp); 
        $fileName = $pName.$fileType.".".$extension;
        // file_exists() : 서버에 특정 파일이 있는지 확인
        if (!file_exists($dirPath."/".$fileName)) { 
            // move_uploaded_file : 서버로 전송된 파일을 저장.
            move_uploaded_file($fileArray[1], $dirPath."/".$fileName); 
            return $dirPath."/".$fileName;
        }
    }

    // 프로젝트 폴더 만들기 + IR, img 업로드
    $dirPath = "Projects/".$pName;
    if (!is_dir($dirPath)) {
        mkdir($dirPath, 0777, true);
        // echo $temp_logo[0]."<br>".$temp_logo[1]."<br><br>";
        // echo $temp_IR[0]."<br>".$temp_IR[1]."<br><br>";
        $pathLogo = UploadLocalFile($temp_logo, "_Logo");
        $pathIR = UploadLocalFile($temp_IR, "_IR");
        $pathThumnail = UploadLocalFile($temp_thumnail, "_Thumnail");
        $pathThumnailBig = UploadLocalFile($temp_thumnailBig, "_ThumnailBig");
        $pathStoryline = UploadLocalFile($temp_storyline, "_Storyline");
        $pathSummary = UploadLocalFile($temp_summary, "_Summary");
    }

    // echo $pathLogo;
    // echo $pathIR;
    // echo $pathThumnail;
    // echo $pathThumnailBig;
    // echo $pathStoryline;
    // echo $pathSummary;

    // *** insert project
    $q_project = $db->prepare("INSERT INTO tbl_project (
                                                      f_project_name
                                                     ,f_storyline
                                                     ,f_summary
                                                     ,f_donate_limit 
                                                     ,f_cardbank
                                                     ,f_cardnum
                                                     ,f_date_limit
                                                     ,f_par_value 
                                                     ,sys_register_id 
                                                     ,f_div)
                                    VALUES( ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Y');                                                                                                                                           ,'Y'
                            ");
    $q_project->execute(array($pName, $storyline, $summary, $donateLimit, $etpBank, $f_cardnum,
                              $dateLimit, $etpPerValue, $register_id));
    $q_project->closeCursor();

    // 셀렉트, 이름으로 프젝id 찾기
    $q_projectID = $db->prepare("SELECT ai_project_id FROM tbl_project WHERE f_project_name = ?");
    $q_projectID->execute(array($pName));
    $row = $q_projectID->fetch(PDO::FETCH_ASSOC);
    $project_ID = $row["ai_project_id"];
    $q_projectID->closeCursor();

    // *** insert category
    $q_category = $db->prepare("INSERT INTO tbl_pj_category (sys_project_id, sys_category_id) VALUES (?, ?);");
    $q_category->execute(array($project_ID, $pCategory));
    $q_category->closeCursor();


    
    // *** insert enterprise
    $q_enterprise = $db->prepare("INSERT INTO tbl_enterprise ( 
                                                    sys_project_id
                                                    ,f_etp_name
                                                    ,f_etp_desc
                                                    ,f_etp_logo
                                                    ,f_etp_url
                                                    ,f_etp_value
                                                    ,f_etp_ir)
                                        VALUES( ?, ?, ?, ?, ?, ?, ?);
                                ");
    $q_enterprise->execute(array($project_ID, $etpName, $etpDesc, $pathLogo, $etpURL, $etpValue, $pathIR));
    $q_enterprise->closeCursor();

    // *** insert image
    $q_img = $db->prepare("INSERT INTO tbl_img ( 
                                            sys_project_id
                                            ,f_thumbnail
                                            ,f_thumbnail_big
                                            ,f_storyline_img
                                            ,f_summary_img
                                            ,f_gamepv)
                                    VALUES( ?, ?, ?, ?, ?, ? );
                                ");
    $q_img->execute(array($project_ID, $pathThumnail, $pathThumnailBig, $pathStoryline, $pathSummary, $trailer));
    $q_img->closeCursor();
    
    // *** insert rewards
    for($i=0; $i<sizeof($_REQUEST["re_money"]); $i++){
        $q_rewards = $db->prepare("INSERT INTO tbl_rewards (
                                               sys_project_id
                                               ,f_reward_div
                                               ,f_reward_desc
                                               ,f_reward_cont
                                               ,f_reward_money
                                               ,f_div)
                                   VALUES( ?, ?, ?, ?, ?, 'Y');
                                   ");
        $q_rewards->execute(array($project_ID, $re_div[$i], $re_descript[$i], $re_content[$i], $re_money[$i])); 
        $q_rewards->closeCursor();   
    }

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>펀웨어 - 프로젝트 만들기</title>
</head>
<body>
    <script>
        alert("등록되었습니다!");
        location.href = "projectDetail.php?p_num=<?=$project_ID?>";
    </script>
</body>
</html>

 <?php   
    
    
}catch(Exception $e){
    echo $e;
}finally{

}
?>

