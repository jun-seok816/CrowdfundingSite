const express = require('express');
const app = express();
const template = require('./lib/template.js')
const mainTemplate = require(`./lib/main_template.js`)
const championJson = require(`./lib/champion/champion.json`);
const url = require('url');
const XMLHttpRequest = require("xmlhttprequest").XMLHttpRequest;


const mysql = require('mysql');  // mysql 모듈 로드
const { match } = require('assert');
const conn = {  // mysql 접속 설정
    host: '127.0.0.1',
    port: '3306',
    user: 'junseok816',
    password: 'tlsrn815',
    database: 'loldb'
};



function httpGet(theUrl)
{
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", theUrl, false ); // false for synchronous request
    xmlHttp.send( null );
    return JSON.parse(xmlHttp.responseText);
}

app.use(express.static('img'));
app.use(express.static('lib'));

app.get('/', function (request, res) {
   
    var html = '';

    let rotation ='https://kr.api.riotgames.com/lol/platform/v3/champion-rotations?api_key=RGAPI-5993ad76-dc10-4e28-9773-297194216021';
    let rotation_result =httpGet(rotation);

    let array = new Array();
    for(key in championJson.data){
        
        rotation_result.freeChampionIds.forEach(e => {
            if(championJson.data[key].key == e){
                array.push(championJson.data[key].id);
            }
        });
        
    }
    
    list = mainTemplate.LIST(array);
    html = mainTemplate.HTML(list);
    res.send(html);

})





app.get('/search',function (request, res) {
  
    var html ='';
    let _url = request.url;
    let queryData = url.parse(_url,true).query;

    let summoner = encodeURI(queryData.id);
    
    // let startTime='';
    // new Date().getTime()
    var connection = mysql.createConnection(conn); // DB 커넥션 생성


    connection.query(`SELECT *
                    FROM summonertbl AS J_summonertbl
                    JOIN matchtbl AS J_match
                    ON J_summonertbl.summonerID = J_match.summonerID
                    WHERE J_summonertbl.summonerName = ? 
                    ORDER BY J_match.matchID DESC`,queryData.id,function(err,summonerSelect,fields){
    
        let summonerNameURL = "https://kr.api.riotgames.com/lol/summoner/v4/summoners/by-name/"+summoner + "?api_key=RGAPI-5993ad76-dc10-4e28-9773-297194216021";
        let NameObject = httpGet(summonerNameURL);
       

        let leagueURL ="https://kr.api.riotgames.com/lol/league/v4/entries/by-summoner/" +NameObject.id+ "?api_key=RGAPI-5993ad76-dc10-4e28-9773-297194216021";
        let LeagueObject = httpGet(leagueURL);
        console.log(summonerSelect[0])

        if(summonerSelect[0] === undefined){
            console.log('DB에 값 없음');
            //DB에 값이 없으면 INSERT?  
            
            console.log(LeagueObject);
            var tier = null;
            var rank = null;
            var leaguePoints = null;
            var wins = null;
            var losses = null;
            if(LeagueObject[1] != undefined){
               tier = LeagueObject[1].tier;
               rank = LeagueObject[1].rank;
               leaguePoints = LeagueObject[1].leaguePoints;
               wins = LeagueObject[1].wins;
               losses = LeagueObject[1].losses;
            }
        
            let matchURL_Key ="https://asia.api.riotgames.com/lol/match/v5/matches/by-puuid/"+NameObject.puuid+"/ids?start=0&count=5&api_key=RGAPI-5993ad76-dc10-4e28-9773-297194216021"
       
            let Match_keyObject = httpGet(matchURL_Key);


            let summonerArr = new Array();
            summonerArr.push(NameObject.id,NameObject.name,NameObject.profileIconId,NameObject.summonerLevel,NameObject.puuid,LeagueObject[0].tier,LeagueObject[0].rank,LeagueObject[0].leaguePoints,LeagueObject[0].wins,LeagueObject[0].losses,tier,rank,leaguePoints,wins,losses);

            var summonerQuery = "INSERT INTO summonertbl (summonerID,summonerName,profileIconId,summonerLevel,puuid,tier1,rank1,leaguePoints1,wins1,losses1,tier2,rank2,leaguePoints2,wins2,losses2)  VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
            connection.query(summonerQuery,summonerArr, function (err, results, fields) { 
                console.log('INSERT summonertbl');
                if (err) {
                    console.log('summonerQuery에러: ' + err);
                }
                console.log(results);
            });

            /** Insert matchdetailtbl **/

            var matchQuery = `INSERT INTO matchdetailtbl (
                                                        matchPK
                                                        ,matchID
                                                        ,assists
                                                        ,death
                                                        ,kills
                                                        ,item0
                                                        ,item1
                                                        ,item2
                                                        ,item3
                                                        ,item4
                                                        ,item5
                                                        ,item6
                                                        ,totalDamageDealtToChampions
                                                        ,summoner1Id
                                                        ,summoner2Id
                                                        ,summoner1Casts
                                                        ,summoner2Casts
                                                        ,win
                                                        ,visionWardBoughtInGame
                                                        ,totalMinionsKilled
                                                        ,neutralMinionsKilled
                                                        ,championName
                                                        ,gameMode
                                                        ,summonerName
                                                        )  VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);`

            var pKQuery = "INSERT INTO matchtbl (matchID,summonerID,timestamp)  VALUES (?,?,?);";

            Object.keys(Match_keyObject).forEach(e=>{
                let matchDetail2 = httpGet("https://asia.api.riotgames.com/lol/match/v5/matches/"+Match_keyObject[e]+"?api_key=RGAPI-5993ad76-dc10-4e28-9773-297194216021");//너무느려
                let i =0;
                var pkArr = new Array();
                pkArr.push( matchDetail2.metadata.matchId,NameObject.id,Math.floor(matchDetail2.info.gameCreation / 1000));

                while(i<10){
                    var matchArr = new Array();
                    
                    matchArr.push(
                        matchDetail2.metadata.matchId+'_'+i
                        ,matchDetail2.metadata.matchId
                        ,matchDetail2.info.participants[i].assists
                        ,matchDetail2.info.participants[i].deaths
                        ,matchDetail2.info.participants[i].kills
                        ,matchDetail2.info.participants[i].item0
                        ,matchDetail2.info.participants[i].item1
                        ,matchDetail2.info.participants[i].item2
                        ,matchDetail2.info.participants[i].item3
                        ,matchDetail2.info.participants[i].item4
                        ,matchDetail2.info.participants[i].item5
                        ,matchDetail2.info.participants[i].item6
                        ,matchDetail2.info.participants[i].totalDamageDealtToChampions
                        ,matchDetail2.info.participants[i].summoner1Id
                        ,matchDetail2.info.participants[i].summoner2Id
                        ,matchDetail2.info.participants[i].summoner1Casts
                        ,matchDetail2.info.participants[i].summoner2Casts
                        ,matchDetail2.info.participants[i].win
                        ,matchDetail2.info.participants[i].visionWardsBoughtInGame
                        ,matchDetail2.info.participants[i].totalMinionsKilled
                        ,matchDetail2.info.participants[i].neutralMinionsKilled
                        ,matchDetail2.info.participants[i].championName
                        ,matchDetail2.info.gameMode
                        ,matchDetail2.info.participants[i].summonerName
                        );
                    
                    i++;
                    connection.query(matchQuery,matchArr, function (err, results, fields) { // testQuery 실행
                        if (err) {
                            console.log('에러matchQuery: ' + err);
                        }
                    });
                   
                }
                connection.query(pKQuery,pkArr, function (err, results, fields) { // testQuery 실행
                    if (err) {
                        console.log('에러pKQuery: ' + err);
                    }
                    console.log(results);
                });
            }); 


            connection.query(`SELECT *
                            FROM matchdetailtbl AS J_matchdetail
                            JOIN matchtbl AS J_match
                            ON J_matchdetail.matchID = J_match.matchID
                            WHERE summonerID = ? `,NameObject.id, function (err, results, fields) { // testQuery 실행
             
                
                tables = template.LIST(results);
                list = template.TABLE(tables,results);
                
                connection.query(`SELECT * FROM summonertbl WHERE summonerName=?`,queryData.id, function (err, results, fields) { 
                    
                    if(err) console.log("SELECT * FROM summonertbl: "+err);
                    html = template.HTML(
                        results
                        ,list
                    )
                    res.send(html);
                })
             
               
            });

        }else if(summonerSelect[0].timestamp < new Date().getTime()){
            console.log("값은 있는데 업데이트")
            var tier = null;
            var rank = null;
            var leaguePoints = null;
            var wins = null;
            var losses = null;
            if(LeagueObject[1] != undefined){
               tier = LeagueObject[1].tier;
               rank = LeagueObject[1].rank;
               leaguePoints = LeagueObject[1].leaguePoints;
               wins = LeagueObject[1].wins;
               losses = LeagueObject[1].losses;
            }
        
            let matchURL_Key ="https://asia.api.riotgames.com/lol/match/v5/matches/by-puuid/"+NameObject.puuid+"/ids?startTime="+summonerSelect[0].timestamp+"&start=0&count=5&api_key=RGAPI-5993ad76-dc10-4e28-9773-297194216021";
            let Match_keyObject = httpGet(matchURL_Key);
            console.log(Match_keyObject);


            /** Insert matchdetailtbl **/

            var matchQuery = `INSERT INTO matchdetailtbl (
                                                        matchPK
                                                        ,matchID
                                                        ,assists
                                                        ,death
                                                        ,kills
                                                        ,item0
                                                        ,item1
                                                        ,item2
                                                        ,item3
                                                        ,item4
                                                        ,item5
                                                        ,item6
                                                        ,totalDamageDealtToChampions
                                                        ,summoner1Id
                                                        ,summoner2Id
                                                        ,summoner1Casts
                                                        ,summoner2Casts
                                                        ,win
                                                        ,visionWardBoughtInGame
                                                        ,totalMinionsKilled
                                                        ,neutralMinionsKilled
                                                        ,championName
                                                        ,gameMode
                                                        ,summonerName
                                                        )  VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);`

            var pKQuery = "INSERT INTO matchtbl (matchID,summonerID,timestamp)  VALUES (?,?,?);";

            Object.keys(Match_keyObject).forEach(e=>{
                let matchDetail2 = httpGet("https://asia.api.riotgames.com/lol/match/v5/matches/"+Match_keyObject[e]+"?api_key=RGAPI-5993ad76-dc10-4e28-9773-297194216021");//너무느려
                let i =0;
                var pkArr = new Array();
                pkArr.push( matchDetail2.metadata.matchId,NameObject.id,Math.floor(matchDetail2.info.gameCreation / 1000));

                while(i<10){
                    var matchArr = new Array();
                    
                    matchArr.push(
                        matchDetail2.metadata.matchId+'_'+i
                        ,matchDetail2.metadata.matchId
                        ,matchDetail2.info.participants[i].assists
                        ,matchDetail2.info.participants[i].deaths
                        ,matchDetail2.info.participants[i].kills
                        ,matchDetail2.info.participants[i].item0
                        ,matchDetail2.info.participants[i].item1
                        ,matchDetail2.info.participants[i].item2
                        ,matchDetail2.info.participants[i].item3
                        ,matchDetail2.info.participants[i].item4
                        ,matchDetail2.info.participants[i].item5
                        ,matchDetail2.info.participants[i].item6
                        ,matchDetail2.info.participants[i].totalDamageDealtToChampions
                        ,matchDetail2.info.participants[i].summoner1Id
                        ,matchDetail2.info.participants[i].summoner2Id
                        ,matchDetail2.info.participants[i].summoner1Casts
                        ,matchDetail2.info.participants[i].summoner2Casts
                        ,matchDetail2.info.participants[i].win
                        ,matchDetail2.info.participants[i].visionWardsBoughtInGame
                        ,matchDetail2.info.participants[i].totalMinionsKilled
                        ,matchDetail2.info.participants[i].neutralMinionsKilled
                        ,matchDetail2.info.participants[i].championName
                        ,matchDetail2.info.gameMode
                        ,matchDetail2.info.participants[i].summonerName
                        );
                    
                    i++;
                    connection.query(matchQuery,matchArr, function (err, results, fields) { // testQuery 실행
                        if (err) {
                            console.log('2번째 에러matchQuery: ' + err);
                        }
                    });
                   
                }
                connection.query(pKQuery,pkArr, function (err, results, fields) { // testQuery 실행
                    if (err) {
                        console.log('2번째 에러pKQuery: ' + err);
                    }
                    console.log(results);
                });
            }); 


            connection.query(`SELECT *
                            FROM matchdetailtbl AS J_matchdetail
                            JOIN matchtbl AS J_match
                            ON J_matchdetail.matchID = J_match.matchID
                            WHERE summonerID = ?
                            ORDER BY J_match.matchID DESC `,NameObject.id, function (err, results, fields) { // testQuery 실행
             
                console.log('2번쨰 DB에 값 있음');
                
                tables = template.LIST(results);
                list = template.TABLE(tables,results);
                
                connection.query(`SELECT * FROM summonertbl WHERE summonerName=?`,queryData.id, function (err, results, fields) { 
                    
                    if(err) console.log("SELECT * FROM summonertbl: "+err);
                    html = template.HTML(
                        results
                        ,list
                    )
                    res.send(html);
                })
            })
        }else{
            console.log(summonerSelect[0])
            connection.query(`SELECT *
                            FROM matchdetailtbl AS J_matchdetail
                            JOIN matchtbl AS J_match
                            ON J_matchdetail.matchID = J_match.matchID
                            WHERE summonerID = ?
                            ORDER BY J_match.matchID DESC `,NameObject.id, function (err, results, fields) { // testQuery 실행

                console.log('DB에 값 있음');

                tables = template.LIST(results);
                list = template.TABLE(tables,results);

                connection.query(`SELECT * FROM summonertbl WHERE summonerName=?`,queryData.id, function (err, results, fields) { 
                    
                    if(err) console.log("SELECT * FROM summonertbl: "+err);
                    html = template.HTML(
                        results
                        ,list
                    )
                    res.send(html);
                })

            });
        }
    })
    
})


app.use((req,res,next)=>{
    res.status(404).send('Sorry cant find that!');
})
 
app.listen(3000);



