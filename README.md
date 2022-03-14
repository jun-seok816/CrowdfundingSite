## 목차

* [소개글](#Single-Page-Application)
* [Architecture](#Architecture)
* [Back End Application구조](#Back-End-Application구조)
* [DataBase](#DataBase)
* [PHP 모듈소개](#PHP-모듈소개)

<div align="center">
  <h1>CrowdFunding Site with PHP👀</h1>
<a href="https://hits.seeyoufarm.com"><img src="https://hits.seeyoufarm.com/api/count/incr/badge.svg?url=https%3A%2F%2Fgithub.com%2Fjun-seok816%2FCrowdfundingSite&count_bg=%2379C83D&title_bg=%23555555&icon=&icon_color=%23E7E7E7&title=hits&edge_flat=false"/></a>
</div>  


<br/>
<p align="center">
  <img src="https://user-images.githubusercontent.com/72478198/158101761-23fdee5a-6aae-4c5d-90c0-8166ac87c9d0.gif" alt="animated" />
</p>


<br/>
<p align="center">
  <b>본 문서는 php를 사용하여 만든사이트에 대해 안내합니다</b>
</p>

<h3 align="center">만들어진 사이트는 http://funware.shop/index.php 에서 확인하실 수 있습니다. </h3>   
<br/>
<div align="center">
    <img src="https://img.shields.io/badge/PHP-3D41C8?style=flat-square&logo=PHP&logoColor=white"/>
    <img src="https://img.shields.io/badge/Mysql-3D41C8?style=flat-square&logo=Mysql&logoColor=white"/>
</div>

<br/>


<br/>
<div align="center">
    <h1>Architecture</h1>
    <p align="center">
      <img src="https://user-images.githubusercontent.com/72478198/158101449-fde0b81d-9dd2-4e84-bc75-234916c516df.png" alt="animated" />
    </p>
 </div> 
<br/>


<br/>
<div align="center">
    <h1>Back End Application구조</h1>
    <p align="center">
      <img src="https://user-images.githubusercontent.com/72478198/158101445-6be695fd-3830-4974-8dab-6b5f21afc58d.png" alt="animated" />
    </p>
 </div> 
<br/>



<div align="center">
  <h1>DataBase</h1>
</div> 

## ERD


URL : https://aquerytool.com/aquerymain/index/?rurl=461e7ba1-d288-4744-8c06-2d3877c4ad25&  
Password : 28mbb5

<div align="center">
  <h1>PHP 모듈소개</h1>
  ajax를 이용하여 php호출
</div> 


## ajaxLogin

### Description

사용자 로그인 처리모듈

### Request

#### URL
  
```javascript
POST ajax_src/ajaxLogin.php HTTP/1.1
dataType json
```

#### Parameter

|Name|Type|Description|Required|
|---|---|---------|---|
|email|String|사용자의 아이디|true|
|password|String|사용자의 비밀번호|true|

  
 <br/>
  
### Response

|Name|Type|Description|Required|
|---|---|---------|---|
|success|Boolean|사용자의 로그인 성공 여부|true|
|msg|String|인증 실패 시 반환되는 에러 메시지|false|

<br/>

## ajaxSocialLogin


### Description

구글,네이버,카카오등 쇼셜 사이트를 이용한 로그인처리모듈

### Request

#### URL
  
```javascript
POST ajax_src/ajaxSocialLogin.php HTTP/1.1
dataType json
```
 <br/>
 
#### Parameter

|Name|Type|Description|Required|
|---|---|---------|---|
|email|String|사용자의 쇼셜 이메일|true|
|name|String|사용자의 프로필 이름|true|

  
 <br/>
  
### Response

|Name|Type|Description|Required|
|---|---|---------|---|
|success|Boolean|사용자의 로그인 성공 여부|true|
|msg|String|인증 실패 시 반환되는 에러 메시지|false|

<br/>

## ajaxChangeEmail


### Description

계정 이메일변경

### Request

#### URL
  
```javascript
POST ajax_src/ajaxChangeEmail.php HTTP/1.1
dataType json
```
 <br/>
 
#### Parameter

|Name|Type|Description|Required|
|---|---|---------|---|
|email|String|사용자의 쇼셜 이메일|true|
|authNum|String|인증번호|true|
|memberDiv|String|이메일 활성화 비활성화 여부|true|

  
 <br/>
  
### Response

|Name|Type|Description|Required|
|---|---|---------|---|
|memberDivNum|Number|사용자의 이메일 활성화 여부|true|

<br/>

## ajaxChangeEmail


### Description

계정 비밀번호변경

### Request

#### URL
  
```javascript
POST ajax_src/ajaxChangePW.php HTTP/1.1
dataType json
```
 <br/>
 
#### Parameter

|Name|Type|Description|Required|
|---|---|---------|---|
|currentPW|String|사용자의 현재 비밀번호|true|
|newPW|String|새로운 비밀번호|true|
|checkNewPW|String|비밀번호 체크|true|
|agreeMarketing|String|마케팅정보 받을지 체크|true|

  
 <br/>
  
### Response

|Name|Type|Description|Required|
|---|---|---------|---|
|currChecked|Number|비밀번호가 일치하는지에 대한 |true|

<br/>


## ajaxJoin

### Description

회원가입 및 사용자 인증모듈

### Request

#### URL
  
```javascript
POST ajax_src/ajaxJoin.php HTTP/1.1
dataType: json
```

#### Parameter

|Name|Type|Description|Required|
|---|---|---------|---|
|name|String|사용자의 프로필 이름|true|
|email|String|사용자의 이메일|true|
|password|String|사용자의 비밀번호|true|
|chkMkt|number|사용자의 마케팅정보 받아오기 허용여부|false|

  
 <br/>
  
### Response

|Name|Type|Description|Required|
|---|---|---------|---|
|msg|String,boolean|인증 실패 시 반환되는 에러 메시지|false|

<br/>

## ajaxWithdrawal

### Description

회원탈퇴 처리모듈

### Request

#### URL
  
```javascript
POST ajax_src/ajaxWithdrawal HTTP/1.1
dataType json
```
<br/>

#### Parameter

|Name|Type|Description|Required|
|---|---|---------|---|
|pw|String|사용자의 비밀번호|true|


### Response

|Name|Type|Description|Required|
|---|---|---------|---|
|msg|String|사용자의 로그인 탈퇴 성공여부|true|


<br/>

## ajaxNewDat

### Description

댓글작성 처리모듈

### Request

#### URL
  
```javascript
POST ajax_src/ajaxNewDat.php HTTP/1.1
dataType: json
```

#### Parameter

|Name|Type|Description|Required|
|---|---|---------|---|
|n_num|String|프로젝트의 고유넘버|true|
|newDat|String|댓글의 본문|true|

 <br/>
  
### Response

|Name|Type|Description|Required|
|---|---|---------|---|
|data|object|댓글본문이 작성된 xml 객체|true|

<br/>


## ajaxpayMail

### Description

결제완료 이메일 보내는 모듈

### Request

#### URL
  
```javascript
POST ajax_src/ajaxpayMail HTTP/1.1
dataType: json
```

#### Parameter

|Name|Type|Description|Required|
|---|---|---------|---|
|p_num|Number|프로젝트의 고유번호|true|
|etp_name|String|프로젝트를 기획한 회사이름|true|
|pathIR|String|프로젝트를 기획안 더미자료,ppt주소|true|

  
<br/>
  

## ajaxLike

### Description

좋아요버튼 처리모듈

### Request

#### URL
  
```javascript
POST ajax_src/ajaxLike.php HTTP/1.1
dataType: json
```

#### Parameter

|Name|Type|Description|Required|
|---|---|---------|---|
|userId|Number|사용자의 ID|true|
|p_num|Number|프로젝트의 고유번호|true|

  
 <br/>
  
### Response

|Name|Type|Description|Required|
|---|---|---------|---|
|data|object|좋아요버튼의 xml객체|true|

<br/>






[__junGallery__]: http://jun.cafe24app.com/

