@extends('layouts.master')
@section('content')
    <div id="layout" class="pure-g">
        <div class="sidebar pure-u-1 pure-u-md-1-4">
            <div class="header">
                <h1 class="brand-title">徳井青空の</h1>
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
                <input id="count" type="hidden" style="display: none" value="0">
                <!-- A wrapper for all the blog posts -->
                <div id="posts" class="posts">

                </div>

                <div class="footer">
                    <div class="pure-menu pure-menu-horizontal">
                        <ul>
                            <li class="pure-menu-item"><a href="javascript: loadMore()" class="pure-menu-link">加载更多</a>
                            </li>
                            <li class="pure-menu-item"><a href="https://www.cool2645.com/" class="pure-menu-link">2645
                                    Studio</a></li>
                            <li class="pure-menu-item"><a href="https://twitter.com/tokui_sorangley" class="pure-menu-link">Original
                                    Twitter</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function loadMore() {
            var offset = $("#count").val();
            $.ajax({
                url: "/api/tweets/?pwd=cool2645&offset=" + offset.toString(),
                method: "GET",
                success: function (msg) {
                    var dataObj = eval("(" + msg + ")");
                    for (i in dataObj) {
                        var append_str = '<h1 class="content-subhead">';
                        var newDate = new Date();
                        newDate.setTime(dataObj[i].origin_created_at * 1000);
                        append_str += newDate.toString();
                        append_str += '</h1>\
                            <section class="post">\
                            <header class="post-header">\
                            <img width="48" height="48" alt="avatar" class="post-avatar" src="https://pbs.twimg.com/profile_images/848180751245860865/5QXbLIwb.jpg">\
                            <h2 class="post-title">';
                        append_str += dataObj[i].id;
                        append_str += '</h2>\
                            </header>\
                            <div class="post-description">\
                            <p>';
                        if (dataObj[i].html_content == null)
                            append_str += dataObj[i].text;
                        else
                            append_str += dataObj[i].html_content;
                        append_str += '</p>\
                            </div>';
                        if (dataObj[i].trans_zh_author != null) {
                            append_str += '<div class="post-description">\
                                <p>';
                            append_str += dataObj[i].trans_zh;
                            append_str += '</p>\
                                <label class="content-subhead">翻译自：';
                            append_str += dataObj[i].trans_zh_author;
                            append_str += '</label>\
                                </div>';
                        }
                        append_str += '</section>';
                        $("#posts").append(append_str);
                    }
                }
            });
            $("#count").val(offset + 20);
        }
        $(document).ready(function () {
            loadMore();
        })
    </script>
@endsection
