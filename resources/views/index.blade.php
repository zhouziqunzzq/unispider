@extends('layouts.master')
@section('content')
    <div id="layout" class="pure-g">
        <div class="sidebar pure-u-1 pure-u-md-1-4">
            <div class="header">
                <h1 class="brand-title">南條愛乃の</h1>
                <h2 class="brand-tagline">ツイッターロボット</h2>

                <nav class="nav">
                    <ul class="nav-list">
                        <li class="nav-item">
                            <a class="pure-button" href="http://purecss.io">Pure</a>
                        </li>
                        <li class="nav-item">
                            <a class="pure-button" href="http://yuilibrary.com">YUI Library</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="content pure-u-1 pure-u-md-3-4">
            <div>
                <!-- A wrapper for all the blog posts -->
                <div class="posts">
                    @foreach($tweets as $tweet)
                        <h1 class="content-subhead">{{date("Y-m-d H:i:s",$tweet->origin_created_at)}}</h1>

                        <section class="post">
                            <header class="post-header">
                                <img width="48" height="48" alt="avatar" class="post-avatar" src="/img/n.jpg">
                                <h2 class="post-title">{{$tweet->id}}</h2>
                            </header>

                            <div class="post-description">
                                <p>
                                    {{$tweet->text}}
                                </p>
                            </div>
                        </section>
                    @endforeach

                </div>

                <div class="footer">
                    <div class="pure-menu pure-menu-horizontal">
                        <ul>
                            <li class="pure-menu-item"><a href="https://www.cool2645.com/" class="pure-menu-link">2645 Studio</a></li>
                            <li class="pure-menu-item"><a href="http://twitter.com/nanjolno/" class="pure-menu-link">Original Twitter</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
