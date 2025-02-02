<?php include __DIR__ . '/parts/connect_db.php';
$pageName = 'ab_edit';
$title = '編輯通訊錄資料 - 拉拉的網站';


//基本上，這裡做修改頁面的邏輯是跳到修改頁面的方式去呈現。
//所以會跟ab-add.php 的格式一樣，所以就拿來做修改。
//這裡我們先取得sid的值。然後再去判斷如果沒有sid的值，那我們就不變。直接不處理。
$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
if (empty($sid)) {
    // header('Location: ab_list.php');
    echo $sid;
    exit;
}
//因為上面取得到sid的值所以才會接下來到這裡。
//設定row 就是 sql的語法。如果sql抓到空值，我們也不幹了。就直接保持原來就好。

$row = $pdo->query("SELECT * FROM address_book WHERE sid=$sid")->fetch();
if (empty($row)) {
    header('Location: ab_list.php');
    exit;
}


?>
<?php include __DIR__ . '/parts/html-head.php' ?>
<?php include __DIR__ . '/parts/navbar.php' ?>

<style>
    .form-control .border-danger {
        border: 1px solid #f77885;
    }

    .form-text .red {
        color: var(--bs-red);
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card" ">
                <div class=" card-body">
                <h5 class="card-title">編輯資料</h5>
                <form name="form1" onsubmit="sendData(); return false;" novalidate>
                    <!-- 如果看到data- 的開頭等於是用戶自己設定。基本上是不想把這個刪掉，所以前面加data- 是ok的 -->
                    <!-- return false 的意思是解除預設行為 -->
                    <input type="hidden" name="sid" value="<?= $row['sid'] ?>">

                    <div class="mb-3">
                        <!-- 這裡的sendData 運用的方式是 AJAX的格式 -->
                        <label for="name" class="form-label">* name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= htmlentities($row['name']) ?>" required>
                        <div class="form-text text-danger"></div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">email</label>
                        <input type="text" class="form-control" id="email" name="email" value="<?= $row['email'] ?>">
                        <div class="form-text text-danger"></div>
                    </div>

                    <div class="mb-3">
                        <label for="mobile" class="form-label">mobile</label>
                        <input type="text" class="form-control" id="mobile" name="mobile" pattern="09\d{8}" value="<?= $row['mobile'] ?>">
                        <div class="form-text text-danger"></div>
                    </div>

                    <div class="mb-3">
                        <label for="birthday" class="form-label">birthday</label>
                        <input type="date" class="form-control" id="birthday" name="birthday" value="<?= $row['birthday'] ?>">
                        <!-- html5 的功能 -->
                        <div class="form-text"></div>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">address</label>
                        <textarea class="form-control" name="address" id="address" cols="30" rows="3" value="<?= $row['address'] ?>"></textarea>
                        <div class="form-text"></div>
                    </div>

                    <!-- <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div> -->
                    <button type="submit" class="btn btn-primary">修改資料</button>
                </form>
                <div id="info-bar" class="alert alert-success" role="alert" style="display: none;">
                    資料新增成功
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php include __DIR__ . '/parts/script.php' ?>
<script>
    const row = <?= json_encode($row, JSON_UNESCAPED_UNICODE); ?> // unicode 是中文


    const email_re = /\S+@\S+\.\S+/;
    const mobile_re = /^09\d{2}-?\d{3}-?\d{3}$/;

    const name_f = document.form1.name;
    const email_f = document.form1.email;
    const mobile_f = document.form1.mobile;
    const info_bar = document.querySelector('#info-bar');

    const fields = [name_f, email_f, mobile_f];
    const fieldText = [];
    for (let f of fields) {
        fieldText.push(f.nextElementSibling);
    }

    async function sendData() {
        //TODO:欄位檢查

        //讓外觀回复原狀

        for (let i in fields) {
            fields[i].classList.remove('border-danger');
            fieldText.innerText = '';
        }

        info_bar.style.display = "none"; //隱藏訊息

        let isPass = true;

        if (name_f.value.length < 2) {

            // name_f.classList.add('text-danger'); 
            //這個add只能追加子class，所以必須寫主class (.要加的class)


            // name_f.nextElementSibling.classList.add('red'); //會被找最符合且最接近的class然後做附加。
            //classList 是 element，裡面有add 和 remove，item三種元素
            // element.nextElementSibling的意思是

            // name_f.closest('.mb-3').querySelector('.form-text').classList.add('text-danger');
            //這一個會直接指向最大的class然後再指向最大的class的東西後附加效果。

            fields[0].classList.add('border-danger');
            fieldText[0].classList.add('text-danger');
            fieldText[0].innerText = "名字至少要两个字以上";
            // alert('Bro,連名字都亂寫咩');
            isPass = false;
        } //javascript的判斷 name的部分。

        if (email_f.value && !email_re.test(email_f.value)) {
            fields[1].classList.add('border-danger');
            fieldText[1].classList.add('text-danger');
            fieldText[1].innerText = "Email的格式錯誤";
            // alert("Email錯9lan賽咯,diu");
            isPass = false;
        } //email的格式的判斷。

        if (mobile_f.value && !mobile_re.test(mobile_f.value)) {
            // alert("Walao,手機號碼都寫錯咩");
            fields[2].classList.add('border-danger');
            fieldText[2].classList.add('text-danger');
            fieldText[2].innerText = "手機格式錯誤";
            isPass = false;
        }

        if (!isPass) {
            return; //如果ispass不等於true的話，就直接return，一下都不進行了。
        }


        const fd = new FormData(document.form1);
        const r = await fetch('ab_edit_api.php', {
            method: 'POST',
            body: fd,
        });
        const result = await r.json();
        console.log(result);
        info_bar.style.display = 'block'; //顯示alert
        $come_from = 'ab_list.php';
        if (!empty($_SERVER['HTTP_REFERER'])) {
            $come_from = $_SERVER['HTTP_REFERER'];
        }

        if (result.success) {
            info_bar.classList.remove('alert-danger');
            info_bar.classList.add('alert-success');
            info_bar.innerText = "修改成功";
            setTimeout(() => {


                header("Location: $come_from");
            }, 2000);
        } else {
            info_bar.classList.remove('alert-success');
            info_bar.classList.add('alert-danger');
            info_bar.innerText = result.error || '資料無法修改';
        }
    }
</script>
<?php include __DIR__ . '/parts/html-foot.php' ?>