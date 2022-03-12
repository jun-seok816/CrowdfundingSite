const e = require("express");

module.exports = {
    HTML:function (list) {
        return `
            <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Document</title>
                    <link rel="stylesheet" href="main.css">
                </head>
                <body>
                    <div id="main_img">
                        <img class="mainimg" src="https://opgg-static.akamaized.net/logo/20210927154153.68fa18d101dc4b7b9b6f1ad695bec185.png" title="나르" alt="OP.GG Logo (나르)" class="Image">
                    </div>
                    <div id="rank_search">
                            <div id="search_flex">
                                <p class="title">소환사 검색</p>
                                <img onClick="location.href='http://localhost:3000/';" src="logo.png" alt="">
                            </div>
                            <form action="http://localhost:3000/search" id="form_style" method="get">
                                <div class="search_form">
                                    <input type="text" id="search_summoner" placeholder="소환사 이름을 입력하세요" name="id">
                                    <Button type="submit" id="btn_search">검색</Button>
                                </div>
                            </form>
                    </div>
                    <div id="lotation_box">
                        <p class="title">금주의 로테이션</p>
                        <div>
                            ${list}
                        </div>
                    </div>
                </body>
                
            </html>
            `
    },
    LIST:function(lotation) {
        let i = 0;
        let listHtml;
        let list='';
        while(i<lotation.length){
            listHtml =
            `
            <img class="lotationimg" src="champion/${lotation[i]}.png" alt="">
            `
            list = list +listHtml;
            i++
        }
        return list;
    }
}
