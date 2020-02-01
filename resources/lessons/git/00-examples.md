# Git

- [Git ва GitHub](#git-github)
- [Excluding URIs](#csrf-excluding-uris)

<a name="git-introduction"></a>
## Git va GitHub

Git koddagi o'zgarishlarni kuzatib borishi, turli odamlar o'rtasida kodlarni sinxronlashtirishi, koddagi o'zgarishlarni asl nusxasini yo'qotmasdan sinab ko'rishi va kodning eski versiyalariga qaytishi mumkin.

GitHub - bu Git bilan hamkorlikni osonlashtirish uchun Git omborlarini Internetda saqlaydigan veb-sayt. Rezervuar bu shunchaki kodni va koddagi barcha o'zgarishlarni kuzatadigan joy.

Laravel makes it easy to protect your application from [cross-site request forgery](https://en.wikipedia.org/wiki/Cross-site_request_forgery) (CSRF) attacks. Cross-site request forgeries are a type of malicious exploit whereby unauthorized commands are performed on behalf of an authenticated user.

Laravel automatically generates a CSRF "token" for each active user session managed by the application. This token is used to verify that the authenticated user is the one actually making the requests to the application.

    <form method="POST" action="/profile">
        @csrf
        ...
    </form>

The `VerifyCsrfToken` [middleware](/docs/{{version}}/middleware), which is included in the `web` middleware group, will automatically verify that the token in the request input matches the token stored in the session.

#### CSRF Tokens & JavaScript
When building JavaScript driven applications, it is convenient to. 


> {tip} The CSRF middleware is automatically disabled when [running tests](/docs/{{version}}/testing).

