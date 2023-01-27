<div class="container">
    <div class="comments__block">
        <div class="comments__header">
            <h1>Комментарии</h1>
        </div>
        <div class="comments__list">
            <?php if(empty($comments)):?>
            <h2>Комментариев нет</h2>
            <?php endif;?>
            <?php foreach($comments as $comment):?>
            <div class="comment">
                <div class="comment__header">
                    <p><?=$comment['username']?></p>
                    <div class="date">
                        <span><?=$comment['time_created_at']?></span> 
                        <span><?=$comment['date_created_at']?></span>
                    </div>
                </div>
                <div class="comment__content">
                    <p><?=$comment['comment']?></p>
                </div>
            </div>
            <?php endforeach;?>
        </div>
        <hr class="line">
    </div>

    <div class="new-comment__block">
        <div class="new-comment__header">
            <h2>Оставить комментарий</h2>
        </div>
        <div class="new-comment">
            <form id="newCommentForm"  action="comments/add" method="post">
                <div class="input__block">
                   <div class="input__text">
                       <label for="username">Ваше имя</label>
                   </div>
                   <input type="text" id="username" name="username" autocomplete="off" title="Латинские и русские буквы от 3 до 100 символов">  
                </div>
                <div class="input__block">
                   <div class="input__text">
                       <label for="comment">Ваш комментарий</label>
                   </div>
                   <textarea class="comment__text" id="comment" name="comment" title="От 3 до 300 символов"></textarea> 
                </div>

                <div class="input__block submit-input">
                    <input class="submit__input" type="submit">
                </div>
            </form>
        </div>
    </div>
</div>