const e = require("express");


module.exports = {
    HTML:function (SummonerObject,list) {
        let queType ="UnRanked";
        let soloInfo ='';
        let soloImg;
        let queTypeTeam ="UnRanked";
        let teamInfo ='UnRanked';
        let teamIMG;
        
        if(SummonerObject[0].tier1==undefined){
            console.log('실행?');
            soloImg='undefined'
        }else{
            queType ="솔로랭크";

            soloInfo = SummonerObject[0].tier1 + '&nbsp' + SummonerObject[0].rank1 + '&nbsp' + SummonerObject[0].leaguePoints1 + '<br>' +
            SummonerObject[0].wins1+'승' +SummonerObject[0].losses1+'패';

            soloImg = SummonerObject[0].tier1;
        }

        if(SummonerObject[0].tier2==undefined){
            teamIMG='undefined';
        }else{
            queTypeTeam ="팀 랭크";

            teamInfo = SummonerObject[0].tier2 +'&nbsp '+SummonerObject[0].rank2 +' &nbsp'+SummonerObject[0].leaguePoints2+'<br>'+
            SummonerObject[0].wins2+'승' +SummonerObject[0].losses2+'패';

            teamIMG = SummonerObject[0].tier2;
        }
        return`
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="what.css" rel="stylesheet">
            <title>Document</title>
        </head>
        <script src="../search_summoner.js"></script>
            <body>
           
                <header>
                    <div class="profile">
                        <div id="profile_left">
                            <span class="face">
                                <img src="profileicon/${SummonerObject[0].profileIconId}.png" alt="">
                            </span>
                            <span class="profile_left">
                                <div>
                                    <span class="name">${SummonerObject[0].summonerName}</span>
                                </div>
                                <div>
                                    <form action="http://localhost:3000/search" id="form_style" method="get">
                                        <div class="search_form">
                                            <input type="text" id="search_summoner" placeholder="소환사 이름을 입력하세요" name="id">
                                            <Button type="submit" id="btn_search">검색</Button>
                                        </div>
                                    </form>
                                </div>
                                <div>
                                    <button id="reload" onclick="alert(a)">전적갱신</button>
                                </div>
                            </span>
                        </div>
                        <div id="logo">
                            <img onClick="location.href='http://localhost:3000/';" src="logo.png" alt="">
                        </div>
                    </div>
                    <div class="ranks">
                        <span class="rank">
                            <span class="tier">
                                <div>${queType}</div>
                                <img style='width:10vh' src="ranked-emblems/${soloImg}.png" alt="">
                            </span>
                            <span> 
                                ${soloInfo}
                            </span>              
                        </span>
                        <span class="rank">
                            <span class="tier">
                                <div>${queTypeTeam}</div>
                                <img src="ranked-emblems/${teamIMG}.png" alt="">
                            </span>
                            <span> 
                                ${teamInfo}
                            </span>              
                        </span>                   
                    </div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
                </header>
                ${list}
            </body>
      
        </html> 
        `;
    },LIST:function (matchDetail) {
        
        let table ="";
        let tables =new Array();
        let gameInfo;
        let list;
        let i = 0;
        
       
        while(i < matchDetail.length){
            if(matchDetail[i].win==1){
                gameInfo = 'true';
            }else(
                gameInfo ='false'
            )
            var kda = new Array();
            matchDetail.forEach(e => {
                var result = ((e.kills+e.assists)/e.death).toFixed(1);
                if(result==Infinity){
                    kda.push('Perpect');
                }else{
                    kda.push(result);
                }
            });

            list =
            `
                <tr class="${gameInfo}">
                    <td class="box">
                        <div class="summoner_img">
                            <img src="champion/${matchDetail[i].championName}.png" alt="">
                            <div class="spell">
                                <img src="spell/${matchDetail[i].summoner1Id}.png" alt="">
                                <img src="spell/${matchDetail[i].summoner2Id}.png" alt="">
                            </div>
                        </div>
                    </td>
                    <td>${matchDetail[i].summonerName}</td>
                    <td><div>${matchDetail[i].kills}/${matchDetail[i].assists}/${matchDetail[i].death}</div>${kda[i]} 평점</td>
                    <td><div>${matchDetail[i].totalDamageDealtToChampions}</div><progress id="progressBar" value="${matchDetail[i].totalDamageDealtToChampions}" max="100000"></progress></td>
                    <td>${matchDetail[i].visionwardBoughtInGame}</td>
                    <td>${matchDetail[i].totalMinionsKilled+matchDetail[i].neutralMinionsKilled}</td>
                    <td class="item">
                        <img src="item/${matchDetail[i].item0}.png" alt="">
                        <img src="item/${matchDetail[i].item1}.png" alt="">
                        <img src="item/${matchDetail[i].item2}.png" alt="">
                        <img src="item/${matchDetail[i].item3}.png" alt="">
                        <img src="item/${matchDetail[i].item4}.png" alt="">
                        <img src="item/${matchDetail[i].item5}.png" alt="">
                        <img src="item/${matchDetail[i].item6}.png" alt="">
                    </td>
                </tr>
            `
            
            
            table = table + list;
            i++;
            if(i%10 == 0){
                tables.push(table);
                table = '';
            }
        }
        return tables;
    },TABLE:function(tables,gameMode){
        let tableHeader;
        let list ="";
        let gameInfo="";
       
        
        let i = 0;
        while(i<tables.length){

            if(i%10 == 0){
                if(gameMode[i].gameMode =='ARAM'){
                    gameInfo = '칼바람';
                }else{
                    gameInfo ='협곡';
                }
            }

            tableHeader =
            `
            <table class="content_table">
            <colgroup></colgroup>
            <thead class="Header">
                <tr>
                    <th>
                        ${gameInfo}
                    </th>
                    <th>
                        
                    </th>
                    <th>
                        KDA
                    </th>
                    <th>
                        피해량
                    </th>
                    <th>
                        제어와드
                    </th>
                    <th>
                        CS
                    </th>
                    <th>
                        아이템
                    </th>
                </tr>
            </thead>
                <tbody>
                    ${tables[i]}
                </tbody>
            </table>
            `
            i++;
            list = list + tableHeader;
        }
        return list;
    }
}