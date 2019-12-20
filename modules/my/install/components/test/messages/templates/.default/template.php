<? use Bitrix\Main\Page\Asset;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
Asset::getInstance()->addJs('https://code.jquery.com/jquery-3.4.1.min.js');
Asset::getInstance()->addJs('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js');
Asset::getInstance()->addCss('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css');
?>


<script src="https://use.fontawesome.com/45e03a14ce.js"></script>
<div class="main_section">
    <div class="container">
        <div class="chat_container">
            <div class="message_section">
                <div class="row">
                    <div class="chat_area">
                        <ul class="list-unstyled">

                            <? foreach ($arResult['MESSAGES'] as $message): ?>
                                <li class="left clearfix">
                                    <div class="chat-body1 clearfix">
                                        <p><?= $message['MESSAGE'] ?></p>
                                        <div class="chat_time pull-right"><?= $message['DATE'] ?></div>
                                    </div>
                                </li>
                            <? endforeach; ?>

                        </ul>
                    </div>
                    <div class="message_write">
                        <textarea id="message-form" class="form-control" placeholder="type a message"></textarea>
                        <div class="clearfix"></div>
                        <div class="button_cont"><a id="send-button" class="example_b" rel="nofollow noopener" href="javascript:void(0)">Send</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const ajaxUrl = "<?= substr($componentPath, 1) . '/ajax.php' ?>";
</script>