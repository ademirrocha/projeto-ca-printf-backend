<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).









## Routes Api





Routes usage in Api.
```
Copie e cole in console

document.getElementById("user-content-menu_docs")
.setAttribute("style", "position: fixed; top: 60px; right: 10px; width: 150;");
document.getElementsByName('user-content-sub-menu2').forEach(function(item){
  item.removeAttribute('hidden');
});
document.getElementsByName('user-content-sub-menu').forEach(function(item){
  item.removeAttribute('hidden');
});
var cssBot = document.createElement('style');
cssBot.innerHTML = '#user-content-menu_docs ul{margin:0;padding:0;list-style:none;width:200px;}'+
'#user-content-menu_docs ul li{position:relative;}#user-content-menu_docs li ul[name="user-content-sub-menu"]{position:absolute;left:-201px;top:0;display:none;}'+
'#user-content-menu_docs li ul[name="user-content-sub-menu2"]{position:absolute;left:-402px;top:0;display:none;}'+
'#user-content-menu_docs ul li a{display:block;text-decoration:none;color:#E2144A;background:#fff;'+
'padding:5px;border:1px solid #ccc;}'+
'*html ul li{float:left;}*html ul li a{height:1%;}'+
'#user-content-menu_docs li:hover ul { display: block; }'+
'#user-content-menu_docs ul li a:hover{text-decoration:underline;font-weight: bold;'+
'background: #ccc; }';
document.getElementsByTagName('head')[0].appendChild(cssBot);



```
<div name="menu_docs" id="menu_docs" class="menu_docs" >
    <h3>Div MenuDocs </h3>
    <ul id="nav"> 
      <li>
        <a href="#routes-api">Routes Api</a>
      </li>
      <li> 
        <a href="#auth">AUTH</a>
        <ul name="sub-menu" hidden="hidden"> 
          <li><a href="#createuser">#UserCreate</a></li> 
          <li><a href="#requestlogin">#Login</a></li> 
        </ul> 
      </li>
      <li> 
        <a href="#events">EVENTS</a> 
        <ul name="sub-menu" hidden="hidden"> 
          <li><a href="#createevent">#CreateEvent</a></li> 
          <li><a href="#getevents">#GetEvents</a></li> 
        </ul> 
      </li>
      <li> 
        <a href="#documents">DOCUMENTS</a> 
        <ul name="sub-menu" hidden="hidden"> 
          <li><a href="#createdocument">#CreateDocument</a></li> 
          <li><a href="#getdocuments">#GetDocuments</a></li> 
          <li><a href="#downloaddocuments">#DownloadDocuments</a></li> 
        </ul> 
      </li>
    </ul>
  </div>


### Auth

Routes de Auth.

### createUser

```

OBS: São obrigatórios Campos com "Required"

=> #createUser

POST: https://project-ca-printf-backend.herokuapp.com/api/auth/register

User: "Anônimo"

in headers:{
  "Content-Type": "application/json",
  "Accept": "application/json"
}


request:{
  "email": "email", "Required",
  "password": "String", "Required",
  "password_confirmation": "String", "Required",
  "name": "String", "Required",
}


response 201:{
  "data": {
    "id": 1,
    "email": "ademir_ti@live.com",
    "name": "Ademir Rocha"
  },
  "meta": {
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIzIiwianRpIjoiYmNkYWM1ZGFhYjczOGQ4YzVjNTk2OWY0MjA0YjRhYmQ2YWNmMTFmMDBjMjQwZTc5MjExMWE1YTkzYTFjMTA1YjU3MDE4N2FhZWIxMmNiOTMiLCJpYXQiOiIxNjA5MjkyNTM2LjM4NTMwNSIsIm5iZiI6IjE2MDkyOTI1MzYuMzg1MzEwIiwiZXhwIjoiMTY0MDgyODUzNi4zNzYyNTIiLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.c2UI4RdwmTdRLK7OMpN93nz4FVpzM6l7MZlo1Wjqw9tdFfEmkw4adhv_PFZof4JIUWcxPIIrEB-xHzEP6-Iaj9EF9nVrQW9ci6ZZYj8Tya-1AF-hFAuTa0IWTqOa22kUQ5_7yUGf35ur_l5kwgUERLHrhZDtgdP2csy2Qv-Pl-HDQgFcSZFolfdx3RTLsYTDYy_X9lSaM5dYxp136DCl-WKjIUBROlR8OwDPvPGTndZIxsM_f5E7ATyLurpEhVJ2kH4EbVvpXojY4C1pi-TMSEIAMcK9NDjO6-yuwb2z14-i-yR_uxXIKKHzcS86zXLKmOjS4BjxKGSr9iGmNdMmvS2lnT6837r1DU5sdDotVhUFFQKbuD1kUUNbHiFDj2oCPho_HAMlXhqfSdzm6Vp8kArHTlgxvGZhaoguRcgawDec7LSNtTjiszXIe60m6WIlmwQmD1XsBCPW2DtdYq3QM0Ks1jTKIKKsXlXp0ua3smyz7Bc1G58TBROi7AiRIUYAWc6w-cx67yUchXTpW8HUxHR_oQ30ri3gz03M-tnMFwz54ZjRIM3PSupvX7BNpNK"
  }
}

```

### Login

```

=> #Login

POST: https://project-ca-printf-backend.herokuapp.com/api/auth/login

User: "Anônimo"

in headers:{
  "Content-Type": "application/json",
  "Accept": "application/json"
}


request:{
  "email": "string", "Required"
  "password": "string", "Required"
}

response 200:{
  "data": {
    "id": 1,
    "email": "ademir_ti@live.com",
    "name": "Ademir Rocha"
  },
  "meta": {
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIzIiwianRpIjoiYmJjMjFjYzA0NjQyNzlkYmZhMGYwYzAyZDcwOWJmOTAyOTcxZWM1OTc0ZDBjNjBkMTk5MDQ3NzIzNmRjNzEyODZjMzJkNjExZmVlYjA0NTYiLCJpYXQiOiIxNjA5MjkzNjcyLjkwMTg1MyIsIm5iZiI6IjE2MDkyOTM2NzIuOTAxODY0IiwiZXhwIjoiMTY0MDgyOTY3Mi44Nzg1MjciLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.uEFMSOn_IQtyJgv2C4RquecweBaG5i4qxxsH1GrW7tgo_A1V7Otzh_ucrEzeCEiZC5_W7-hlqpzG6iTFahAR8HgwkVkxCZW3kz0Aa9Z5krDej8Bh_f4pg_ZhZrWOQ8zUn8hNfV1FIrOjQJO65x4Dl0gREOyvyi4xFFTXrpkfzJoYdglold2bojLMaA_d6DZ62iIVwRrN--4GK8SMauEhDw_0nX0OcPZ4n3NVsYbMEhG936jsnqz_NkmAXMYufvqlEwcMWwBh897jwOojZDWA_pEeg6Bj06BwfNUb_oaSTSc9pI8xStwAxIfhW6B6ojvWM1RfzCnrfEWeveHc1nJnPAh6FrLapXxBjR-z9sQvNnP2TVcEvUVpq9xh6856hNT7xtX5LzKLleUjKmGhGX0j9SAUDVllsuKCmjLLvtBouPLpCzm3uh0Y6ibMc_AMkfxgL-JCYQdhPoLz7zIK1PQXUStMkGASUPQJLn6ppOTCVuStd4u1GOs03Glslxwh9C6UHOpqCy4qe3EKQoL2L41r5iam75heLmLPvEyQB-N0sK3bsp3"
  }
}

```


### CreateEvent

```

=> #CreateEvent

POST: https://project-ca-printf-backend.herokuapp.com/api/events/new

User: "Auth"

in headers:{
  "Content-Type": "application/json",
  "Accept": "application/json",
  "Authorization": "Bearer " + access_token
}


request:{
  "title": "string", "Required"
  "description": "string", "Required"
  "initial_date": "date", "Required"
  "final_date": "date", "Required"
  "state": "enum in:Ativo,Inativo,Cancelado", "Optional"
}

response 201:{
  "data": {
    "id": 1,
    "title": "Novo Evento",
    "description": "2º evento do CA printf 2021",
    "initial_date": "2021-01-02",
    "final_date": "2021-01-03",
    "state": "Ativo"
  }
}

```

### GetEvents

```

=> #GetEvents

GET: https://project-ca-printf-backend.herokuapp.com/api/events/

User: "Anônimo"

in headers:{
  "Content-Type": "application/json",
  "Accept": "application/json"
}


request:{
  "paginate": "inteiro", "Usado para paginação, default=10", "Optional"
}

response 200:{
  "data": [
    {
      "id": 1,
      "title": "Novo Evento",
      "description": "2º evento do CA printf 2021",
      "initial_date": "2021-01-02",
      "final_date": "2021-01-03",
      "state": "Ativo"
    }
  ],
  "links": {
    "first": "http:\/\/project-ca-printf-backend.herokuapp.com\/public\/api\/events?page=1",
    "last": "http:\/\/project-ca-printf-backend.herokuapp.com\/public\/api\/events?page=1",
    "prev": null,
    "next": null
  },
  "meta": {
    "current_page": 1,
    "from": 1,
    "last_page": 1,
    "links": [
      {
        "url": null,
        "label": "&laquo; Anterior",
        "active": false
      },
      {
        "url": "http:\/\/project-ca-printf-backend.herokuapp.com\/public\/api\/events?page=1",
        "label": 1,
        "active": true
      },
      {
        "url": null,
        "label": "Próxima &raquo;",
        "active": false
      }
    ],
    "path": "http:\/\/project-ca-printf-backend.herokuapp.com\/public\/api\/events",
    "per_page": 10,
    "to": 1,
    "total": 1
  }
}

```

### CreateDocument

```

=> #CreateDocument

POST: https://project-ca-printf-backend.herokuapp.com/api/documents/new

User: "Auth"

in headers:{
  "Content-Type": "application/json",
  "Accept": "application/json",
  "Authorization": "Bearer " + access_token
}


request:{
  "title": "string", "Required"
  "file": "file", "Required"
}

response 201:{
  "data": {
    "id": 2,
    "title": "novo doc",
    "file": "lhRXLyQ56m4HkVRe7jMIMBOBVvtq2w1sQzyeNlzl.png"
  }
}

```

### GetDocuments

```

=> #GetDocuments

GET: https://project-ca-printf-backend.herokuapp.com/api/documents/

User: "Anônimo"

in headers:{
  "Content-Type": "application/json",
  "Accept": "application/json"
}


request:{
  "paginate": "inteiro", "Usado para paginação, default=10", "Optional"
}

response 200:{
  "data": [
    {
      "id": 2,
      "title": "novo doc",
      "file": "lhRXLyQ56m4HkVRe7jMIMBOBVvtq2w1sQzyeNlzl.png"
    }
  ],
  "links": {
    "first": "http:\/\/localhost:8000\/api\/documents?page=1",
    "last": "http:\/\/localhost:8000\/api\/documents?page=1",
    "prev": null,
    "next": null
  },
  "meta": {
    "current_page": 1,
    "from": 1,
    "last_page": 1,
    "links": [
      {
        "url": null,
        "label": "&laquo; Anterior",
        "active": false
      },
      {
        "url": "http:\/\/localhost:8000\/api\/documents?page=1",
        "label": 1,
        "active": true
      },
      {
        "url": null,
        "label": "Próxima &raquo;",
        "active": false
      }
    ],
    "path": "http:\/\/localhost:8000\/api\/documents",
    "per_page": 10,
    "to": 1,
    "total": 1
  }
}

```


### DownloadDocument

```

=> #DownloadDocument

POST: https://project-ca-printf-backend.herokuapp.com/api/documents/download

User: "Auth"

in headers:{
  "Content-Type": "application/json",
  "Accept": "application/json",
  "Authorization": "Bearer " + access_token
}


request:{
  "file": "integer", "exists:documents,id", "Required"
}

response 200:{
  file
}

```



