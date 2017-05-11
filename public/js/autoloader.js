/**
 * Created by zhouz on 2017/4/17.
 */
function loadMore() {
    var offset = $('#count').val();
    var dateMsg = $('#dateMsg');
    var loadingMsg = $('#loadingMsg');
    var loadingHtml = '<div id="loadingMsg"><p>努力加载中...</p> </div>';
    if (typeof(loadingMsg.html()) == "undefined")
        $("#footer").append(loadingHtml);
    else    //Prevent duplicated loading
        return;
    $.ajax({
        url: dateMsg.html() == "未选择日期..." ? "/api/tweets/?pwd=cool2645&offset=" + offset.toString() :
            "/api/tweets/?pwd=cool2645&date=" + dateMsg.html() + "&offset=" + offset.toString(),
        method: "GET",
        success: function (msg) {
            var dataObj = eval("(" + msg + ")");
            var appendCnt = dataObj.length;
            for (i in dataObj) {
                var append_str = '<h1 class="content-subhead">';
                var newDate = new Date();
                newDate.setTime(dataObj[i].origin_created_at * 1000);
                append_str += newDate.toString();
                append_str += '</h1>\
                            <section class="post">\
                            <header class="post-header">\
                            <img width="48" height="48" alt="avatar" class="post-avatar" src="/img/n.jpg">\
                            <h2 class="post-title">';
                append_str += '<a href="https://twitter.com/nanjolno/status/';
                append_str += dataObj[i].origin_id;
                append_str += '">';
                append_str += dataObj[i].id;
                append_str += '</a>';
                append_str += '</h2>\
                            </header>\
                            <div class="post-description">\
                            <p>';
                if (dataObj[i].html_content == null)
                    append_str += dataObj[i].text;
                else
                    append_str += dataObj[i].html_content;
                append_str += '</p>';
                var jsondata = eval("(" + dataObj[i].jsondata + ")");
                for(j in jsondata.media) {
                    if(jsondata.media[j].type == "photo") {
                        append_str += "<center><img class='photo' src='";
                        append_str += jsondata.media[j].media_url_https.replace("https://pbs.twimg.com/media/", "/twimg/");
                        //append_str += jsondata.media[j].media_url_https;
                        append_str += "' /></center>";
                    }
                }
                append_str += '</div>';
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
            var loadingMsg = $('#loadingMsg');
            loadingMsg.remove();
            $("#count").val(parseInt(offset) + appendCnt);
        },
        error: function () {
            $("#posts").html("网络错误，请刷新重试QAQ");
        }
    });

}

$(document).ready(function () {
    loadMore();
});

$(window).scroll(function () {
    var scrollTop = $(document).scrollTop();
    var scrollHeight = $(document).height();
    var windowHeight = $(window).height();
    //console.log("scrollTop: " + (scrollTop) + "\nwindowHeight: " + windowHeight + "\nscrollHeight" + scrollHeight);
    if (scrollTop + windowHeight + 1 >= scrollHeight) {
        //alert("More!");
        loadMore();
    }
});