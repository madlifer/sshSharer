<?php
/**
 * 播放asciinema录制的cast文件以实现SSH轻视频分享，由于asciinema官方链接国内访问慢，通过JSDelivr进行CDN调用。
 *
 * @package sshPlayer
 * @author Madlifer
 * @version 0.1
 * @link https://vicho.me
 * Code modified from editerG project,css&js file upload from @Har-Kuun's repo.
 */
class sshSharer_Plugin implements Typecho_Plugin_Interface
{
    /**
     * 插件版本号
     * @var string
     */
    const _VERSION = '0.1';
    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     *
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static Function activate()
    {
        Typecho_Plugin::factory('admin/write-post.php')->bottom = array('sshSharer_Plugin', 'button');
        Typecho_Plugin::factory('admin/write-page.php')->bottom = array('sshSharer_Plugin', 'button');
    }


public static function button(){
        ?><style>.wmd-button-row {
    height: auto;
}</style>
        <script> 
          $(document).ready(function(){
            $('#wmd-button-row').append('<li class="wmd-button" id="wmd-indent-button" title="SSH轻视频"><span style="background: none;font-size: x-small;text-align: center;vertical-align:middle;display:table-cell;color: #999999;font-family: serif;">SSH</span></li>');
                if($('#wmd-button-row').length !== 0){
                    $('#wmd-indent-button').click(function(){
                        var myCast = prompt("请输入您的cast链接：","https://your.cast");
                        playerCss = '<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/Har-Kuun/sshsharer@1.0/sshsharer-player.css" />';
                        playerJs = '<script src="https://cdn.jsdelivr.net/gh/Har-Kuun/sshsharer@1.0/sshsharer-player.js">' + '</scr'+'ipt>';
                        var text_html = playerCss +"\n" + '<sshsharer-player src="' + myCast +'"></sshsharer-player>' + "\n" + playerJs;
                        zeze(text_html);
                    })
                }

                function zeze(tag) {
                    var myField;
                    if (document.getElementById('text') && document.getElementById('text').type == 'textarea') {
                        myField = document.getElementById('text');
                    } else {
                        return false;
                    }
                    if (document.selection) {
                        myField.focus();
                        sel = document.selection.createRange();
                        sel.text = tag;
                        myField.focus();
                    }
                    else if (myField.selectionStart || myField.selectionStart == '0') {
                        var startPos = myField.selectionStart;
                        var endPos = myField.selectionEnd;
                        var cursorPos = startPos;
                        myField.value = myField.value.substring(0, startPos)
                        + tag
                        + myField.value.substring(endPos, myField.value.length);
                        cursorPos += tag.length;
                        myField.focus();
                        myField.selectionStart = cursorPos;
                        myField.selectionEnd = cursorPos;
                    } else {
                        myField.value += tag;
                        myField.focus();
                    }
                }
            });
</script>
<?php
}
    /**
     * 获取插件配置面板
     *
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
    public static function config(Typecho_Widget_Helper_Form $form){}

    /**
     * 个人用户的配置面板
     *
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form){}

    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     *
     * @static
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function deactivate(){}



}
