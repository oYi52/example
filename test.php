<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <h1>新增題目</h1>
        <form action="controller.php" method="POST">
            <div id="field">
                <input type="hidden" name="count" id="count" value="1">
                <div id="q_1">
                    <h3>題目[1]</h3>
                    <input type="text" name="name_1" placeholder="請輸入題目" required>
                    <div id="option_pool_1">
                        <button onclick="addans(1);return false;">新增答案</button>
                        <input type="hidden" name="ans_1_count" id="ans_1_count" value="1">
                        <div class="q_1_option_set_1">
                            <label for="q_1_option_1">答案1</label>
                            <input type="text" id="q_1_option_1" name="q_1_option_1" placeholder="請輸入選項" required>
                            <label for="q_1_option_1">答案1是正確答案</label>
                            <input type="radio" id="q_1_option_1_cur" name="curans" value="1" required>
                        </div>
                    </div>
                </div>
                <hr>
            </div>
            <button type="button" onclick="addques();return false;">新增題目</button>
            <input type="submit" value="送出">
        </form>
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        var count = $('#count').val();
        function addques(){
            count++;
            $('#count').val(count);
            let ques_content = '<div id="q_'+count+'"> \
                    <h3>題目['+count+']</h3> \
                    <input type="text" name="name_'+count+'" placeholder="請輸入題目" required> \
                    <div id="option_pool_'+count+'"> \
                        <button type="button" onclick="addans('+count+');return false;">新增答案</button> \
                        <input type="hidden" name="ans_'+count+'_count" id="ans_'+count+'_count" value="1"> \
                        <div class="q_'+count+'_option_set_1"> \
                            <label for="q_'+count+'_option_1">答案1</label> \
                            <input type="text" id="q_'+count+'_option_1" name="q_'+count+'_option_1" placeholder="請輸入選項" required> \
                            <label for="q_'+count+'_option_1">答案1是正確答案</label> \
                            <input type="radio" id="q_'+count+'_option_1_cur" name="curans" value="1" required> \
                        </div> \
                    </div> \
                </div> \
                <hr>';
            $("#field").append(ques_content);
        }
        function addans(q){
            var ans_count = $('#ans_'+q+'_count').val();
            ans_count++;
            $('#ans_'+q+'_count').val(ans_count);
            let ans_content =  '<div class="q_'+q+'_option_set_'+ans_count+'"> \
                                    <label for="q_'+q+'_option_'+ans_count+'">答案'+ans_count+'</label> \
                                    <input type="text" id="q_'+q+'_option_'+ans_count+'" name="q_'+q+'_option_'+ans_count+'" placeholder="請輸入選項" required> \
                                    <label for="q_'+q+'_option_'+ans_count+'">答案'+ans_count+'是正確答案</label> \
                                    <input type="radio" id="q_'+q+'_option_'+ans_count+'_cur" name="'+q+'_curans" value="'+ans_count+'" required> \
                                </div>';
            $("#option_pool_"+q).append(ans_content);
        }
    </script>
</html>