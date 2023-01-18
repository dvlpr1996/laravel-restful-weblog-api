<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<style>
    h1{
        font-size: 24px;
    }

    section {
        margin-top: 10px;
    }

    img {
        width: 100%;
        max-width: 90%;
        height: auto;
        display: block;
        margin: 20px auto;
        border-radius: 5px;
    }

    p {
        line-height: 1.5;
        margin-top: 10px;
    }

    span {
        font-size: 14px;
        color: #aaa;
    }
</style>
<body>
    <h1>{{ $title }}</h1>
    <section>
        <article>
            <h4>writen by : {{ $author }}</h4>
            <span>published at : {{ $published_date }}</span>
            <img src="{{ $img }}" alt="{{ $title }}">
            <p>{{ $description }}</p>
        </article>
    </section>
</body>
</html>
