<?php include __DIR__ . '/parts/connect_db.php';

$pageName = 'ab_add';
$title = '新增通訊錄資料 - 拉拉的網站';
$months = array(1 => 'JAN', 2 => 'FEB', 3 => 'MAR', 4 => 'APR', 5 => 'MAY', 6 => 'JUN', 7 => 'JUL', 8 => 'AUG', 9 => 'SEP', 10 => 'OCT', 11 => 'NOV', 12 => 'DEC');

function debug_to_console($data)
{
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

?>
<?php include __DIR__ . '/parts/html-head.php' ?>
<?php include __DIR__ . '/parts/navbar.php' ?>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card" ">
                <div class=" card-body">
                <h5 class="card-title">新增資料</h5>
                <form name="form1" onsubmit="sendData(); return false;" novalidate>
                    <!-- 如果看到data- 的開頭等於是用戶自己設定。基本上是不想把這個刪掉，所以前面加data- 是ok的 -->
                    <!-- return false 的意思是解除預設行為 -->

                    <div class="mb-3">
                        <!-- 這裡的sendData 運用的方式是 AJAX的格式 -->
                        <label for="name" class="form-label">* name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                        <div class="form-text"></div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">email</label>
                        <input type="text" class="form-control" id="email" name="email">
                        <div class="form-text"></div>
                    </div>

                    <div class="mb-3">
                        <label for="mobile" class="form-label">mobile</label>
                        <input type="text" class="form-control" id="mobile" name="mobile" pattern="09\d{8}">
                        <div class="form-text"></div>
                    </div>

                    <div class="mb-3">
                        <label for="birthday" class="form-label">birthday</label>
                        <input type="hidden" class="form-control" id="birthday" name="birthday">

                        <select name="date_mo" id="date_mo">
                            <?php for ($i = 1, $current = (int) date('n'); $i <= 12; $i++) { ?>
                                <option value="<?= $i; ?>" <?= ($current === $i ? ' selected="selected"' : NULL); ?>><?= $months[$i]; ?></option>
                            <?php } ?>
                        </select>

                        <select name="date_dy" id="date_dy">
                            <?php
                            $start_date = 1;
                            $monthss =$_POST['date_mo'] ;
                            debug_to_console($monthss);
                            if ($monthss === 2) {
                                $end_date = 28;
                            } else if ($monthss === 4 || 6 || 9 || 11) {
                                $end_date = 30;
                            } else {
                                $end_date = 31;
                            }
                            for ($i = $start_date; $i <= $end_date; $i++) { ?>
                                <option value="<?= $i; ?>" <?= ($current === $i ? ' selected="selected"' : NULL); ?>><?= $i; ?></option>
                            <?php } ?>
                        </select>

                        <select name="date_yr" id="date_yr">
                            <?php
                            $year = date('Y');
                            $min = $year - 60;
                            $max = $year;
                            for ($i = $max; $i >= $min; $i--) { ?>
                                <option value="<?= $i; ?>"><?= $i; ?></option>
                            <?php } ?>
                        </select>
                        <!-- html5 的功能 -->
                        <!-- <div class="form-text"></div> -->
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">address</label>
                        <textarea class="form-control" name="address" id="address" cols="30" rows="3"></textarea>
                        <div class="form-text"></div>
                    </div>

                    <!-- <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div> -->
                    <button name="todo" type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?php include __DIR__ . '/parts/script.php' ?>
<script>
    const email_re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zAZ]{2,}))$/;
    const mobile_re = /^09\d{2}-?\d{3}-?\d{3}$/;

    const name_f = document.form1.name;
    const email_f = document.form1.email;
    const mobile_f = document.form1.mobile;
    const birth_f = document.form1.birthday;
    const dy = document.form1.date_dy;
    const months = document.form1.date_mo;
    const year = document.form1.date_yr;

    birth_f.value = dy.value + "-" + months.value + "-" + year.value;
    console.log(dy.value);

    async function sendData() {
        //TODO:欄位檢查

        let isPass = true;
        // console.log(birth_f.value);

        if (name_f.value.length < 2) {
            alert('Bro,連名字都亂寫咩');
            isPass = false;
        } //javascript的判斷 name的部分。

        if (email_f.value && !email_re.test(email_f.value)) {
            alert("Email錯9lan賽咯,diu");
            isPass = false;
        } //email的格式的判斷。

        if (mobile_f.value && !mobile_re.test(mobile_f.value)) {
            alert("Walao,手機號碼都寫錯咩");
            isPass = false;
        }

        if (!isPass) {
            return; //如果ispass不等於true的話，就直接return，一下都不進行了。
        }


        const fd = new FormData(document.form1);
        const r = await fetch('ab_add_api.php', {
            method: 'POST',
            body: fd,
        });
        const result = await r.json();
        console.log(result);
    }
</script>
<?php include __DIR__ . '/parts/html-foot.php' ?>