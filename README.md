## 목차

* [소개글](#Single-Page-Application)
* [Architecture](#Architecture)
* [Back End Application구조](#Back-End-Application구조)
* [PHP 모듈소개](#PHP-모듈소개)
* [DataBase](#DataBase)

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



# WebPack

WebPack설정을 어떻게 하였는지 설명합니다.

## entry

엔트리 포인트는 React의 가장 상위 컴포넌트인 index.tsx로 설정하였습니다.

```javascript
 entry: {
            "index" : './src/index.tsx',
        },
```

## output

번들을 내보낼 위치를 BackEnd폴더로 설정하였습니다.

```javascript
 output: {
            path: mv_Path.resolve(__dirname, '../back/views'),
            filename: 'index.js',
            clean : true,
            //chunkFormat: 'commonjs'
        },
```

## resolve

확장자를 설정한대로 순서대로 해석합니다.

```javascript
 resolve: {
        extensions: ['.tsx','.ts','.jsx','.js','.json', '.css', '.scss', 'html'],
  },
```

## module.rules

모듈 규칙설정

### Rule.exclude

node_modules 파일은 번들링하지 않도록 제외하였습니다.


```javascript

module:{
  rules:[
    .../
    {exclude: /node_modules/,}
  ]
}
```

### babel-loader

Javascript 와 JavaScript XML에 해당하는 파일은 babel-loader를 사용하여 컴파일하도록 설정하였습니다.  
@babel/preset-env으로  ES2015+ syntax버전에 맞게 컴파일되도록 하였고,  
@babel/preset-react으로 jsx파일을 컴파일되도록 하였습니다.

```javascript  

module:{
  rules:[
      {
          test: /\.jsx?$/,   // .js or .jsx 
          exclude: /node_modules/,
          use : [
            {
              loader: 'babel-loader',
              options: {
                presets: ['@babel/preset-env', '@babel/preset-react'],
              }
            },
          ],
        },
  ]
}
```


### ts-loader

typescript와 typescript XML에 해당하는 파일은 ts-loader를 사용하여 컴파일하도록 설정하였습니다.


```javascript
module:{
  rules:[
     {
      test: /\.tsx?$/,   
      exclude: /node_modules/,
      use : [
        {
          loader : 'ts-loader'
        }
      ],
    },
  ]
}
```

### style-loader , css-loader , sass-loader

확장자명이 .scss .css에 해당하는 파일을 컴파일하도록 설정하였습니다  
sass-loader로 scss파일을 컴파일 후   
css-loader로 css파일을 컴파일 후  
style-loader로 최종 컴파일하도록 설정하였습니다.

```javascript  
module:{
  rules:[
        {
          test: /\.(sc|c)ss$/,  // .scss .css
          use: [
            //'cache-loader',
            //MiniCssExtractPlugin.loader,
            'style-loader',
            'css-loader',
            'sass-loader'
          ]
        },
  ]
}
```

### file-loader

해당하는 확장자명을 가진 파일을 컴파일합니다.
만약 파일이름이 동일할 시 앞에 hash코드를 덧붙여 파일이름을 다르게 설정하도록하였습니다.

```javascript
module:{
  rules:[
    {
      test: /\.(png|jpg|gif|svg|html)$/,
      loader: 'file-loader',
      options: {
        name: '[name].[ext]?[hash]'
      }
    }
  ]
}
```

### devtool

개발자도구로 디버깅하기 용이하게 소스맵을 볼 수 있도록 설정하였습니다.

```javascript
 devtool: 'inline-source-map',
```

### optimization 

코드들을 알아볼 수 있게 minimize 설정을 false로 하였습니다.

```javascript
optimization: {
    minimize: false,
 },
```

### HtmlWebpackPlugin

webpack 번들을 제공하는 HTML 파일을 설정한되로 생성하도록 하였습니다.

```javascript
 plugins: [
    new HtmlWebpackPlugin({
      filename: 'index.html',
      minify:false,
      templateContent: `
      <html>
        <head>
          <link href='//spoqa.github.io/spoqa-han-sans/css/SpoqaHanSansNeo.css' rel='stylesheet' type='text/css'>
        </head>
        <body>
          <div id="app"></div>
        </body>
      </html>
    `
    })
  ],
```

### devServer

개발자 서버를 사용하여 애플리케이션을 더 빠르게 제작하였습니다.

### historyApiFallback

index.html페이지는 404응답 대신 제공되도록 하였습니다.  
경로가 '/' 일때 index.html이 응답되도록 하였습니다.

```javascript
devServer:{
  historyApiFallback: {
            rewrites : [
              { from: /^\/$/, to: 'index.html' }
            ]
          },
}         
```

### static

옵션을 사용하여 디렉터리에서 정적 파일을 제공하였습니다.

```javascript
const mv_Path = require('path')

//...
devServer:{
  static : [
            {
              directory: mv_Path.resolve(__dirname, './demo'),
              publicPath: '/',
              watch: true,
            },
            {
              directory: mv_Path.resolve(__dirname, './src'),
              publicPath: '/jsLib',
              watch: true,
            },
          ],
}         

```

### client

* progress : 브라우저에서 컴파일 진행률을 백분율로 인쇄합니다.
* overlay : 컴파일중에 오류나 경고가 있는 경우 브라우저에 오류를 뿌리도록 설정합니다.  

```javascript
 client : {
            progress : true,
            overlay: true,
          },
```

### NODE_ENV가 production일때 처리

개발자용 build가 아닌 배포용 build를할때 처리방식입니다.  
webpack객체의 devtool을 source-map으로 설정하여 개발자모드에서 소스내용을 볼 수 없게합니다.  
webpack객체의 plugins에 설정값을 추가합니다.  

* DefinePlugin은 컴파일 시간에 코드의 변수를 다른 값이나 표현식으로 바꿉니다.
* LoaderOptionsPlugin은 전역로더에 minimize옵션을 추가하여 번들을 최소화합니다.

```javascript
const mv_Result ={
//...
  devtool: 'inline-source-map',
  /...
  plugins: [
  /...
  ],

  if (process.env.NODE_ENV === 'production') {
    //module.exports.devtool = 'inline-source-map'
    mv_Result.devtool = 'source-map'
    // http://vue-loader.vuejs.org/en/workflow/production.html
    mv_Result.plugins = (module.exports.plugins || []).concat([
      new webpack.DefinePlugin({
        'process.env': {
          NODE_ENV: '"production"'
        }
      }),
      new webpack.LoaderOptionsPlugin({
        minimize: true
      })
    ])
  }
}
```


[__junGallery__]: http://jun.cafe24app.com/

