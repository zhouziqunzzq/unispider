@extends('layouts.master')
@section('nav')
@endsection
@section('content')
    <div id="layout" class="pure-g">


        <div class="content pure-u-1 pure-u-md-3-4">
            <div>
                <!-- A wrapper for all the blog posts -->
                <div class="posts">
                    @foreach($tweets as $tweet)
                        <h1 class="content-subhead">{{$tweet->origin_created_at}}</h1>

                        <section class="post">
                            <header class="post-header">
                                <h2 class="post-title">Tweet</h2>

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
                            <li class="pure-menu-item"><a href="http://purecss.io/" class="pure-menu-link">About</a></li>
                            <li class="pure-menu-item"><a href="http://twitter.com/yuilibrary/" class="pure-menu-link">Twitter</a></li>
                            <li class="pure-menu-item"><a href="http://github.com/yahoo/pure/" class="pure-menu-link">GitHub</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('footer', 'testfooter')
