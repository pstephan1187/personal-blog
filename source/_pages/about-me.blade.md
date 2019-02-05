---
title: About Me
sort_order: 4
image: joshua-ness-322881.jpg
image_link: https://unsplash.com/photos/cqyfuX_x_ag
photographer: Joshua Ness
---

## Who Am I?

<img class="text-img-left" style="max-width: 200px;" src="/images/patrick-stephan-sq.jpg" alt="Patrick Stephan"> I am a self taught web developer. My career started with simple websites and progressed as I learned Flash Actionscript 3, PHP, MySQL and Javascript. Programming became a large part of my life when I read <a href="https://www.amazon.com/PHP-MySQL-Dummies-Computer-Tech/dp/0470096004/" target="_blank" rel="nofollow">"PHP &amp; MySQL for Dummies"</a>. I started off building applications in the late 00's on completely procedural code. I slowly started getting better as I followed other developers on Twitter and learned the CodeIgniter and <a href="https://www.laravel.com" target="_blank" rel="nofollow">Laravel</a> PHP frameworks, and the AngularJS and Vue.js Javascript frameworks.

I live in the St Louis, Missouri area, go to church regularly, and love to spend time with my wife, Mandy, and baby girl, Abigail. I also enjoy amateur photography, the outdoors, and international cuisines.

## What do I do?

I am a full-stack developer. I specialize in building web based applications with Laravel and Vue.JS and I really enjoy building SPAs (single page applications) and fluid, easy-to-use UI's.

I currently work for the <a href="https://www.314allstar.com" target="_blank" rel="nofollow">All Star</a> dealership in Bridgeton, Missouri building applications and websites to help increase sales and improve inventory pricing.

I have previously worked for <a href="https://acertusdelivers.com/" target="_blank" rel="nofollow">Metrogistics</a> (now branded as Acertus) a vehicle transportation brokerage company, where I helped build and maintain all of the company's internal applications.

I have also worked for a couple of web development firms in the past: <a href="http://www.blusolutions.com" target="_blank" rel="nofollow">BluSolutions</a>, an agency specializing in car dealership websites, and <a href="https://www.prochurch.com" target="_blank" rel="nofollow">Divine Design (now ProChurch)</a>, an agency specializing in church websites.

<hr>

If you are interested in hiring me, I can provide a resume on request. You can reach me on:

<ul class="list-inline">
    @foreach($page->social as $social)
        <li class="list-inline-item"><a href="{{ $social['url'] }}" class="social-icon mr-3" target="_blank" title="{{ $social['label'] }}">
            <i class="fa fa-{!! $social['icon'] !!}"></i> {{ $social['label'] }}
        </a></li>
    @endforeach
</ul>
