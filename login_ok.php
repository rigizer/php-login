<?php
    include "db_connection.php";

    $user_id = $_POST['user_id'];
    $user_pw = $_POST['user_pw'];

    $sql = insert into ~~ value (user_id, test_pw);

    // 로그인 실패시 경고창 띄우는 함수
    function login_fail() {
        echo "
            <script>
                alert('아이디 혹은 패스워드를 다시 한 번 확인하세요');
                history.back();
            </script>
        ";

        return;
    }

    if ($user_id == "" || $user_pw == "") {
        login_fail();
    }

    $sql = "select * from user_info where id = '".$user_id."'";
    $result = mysqli_query($db_connection, $sql);

    $result_num = mysqli_num_rows($result);
    
    // 데이터베이스에 아이디가 존재하지 않는 경우
    if (!$result_num) {
        login_fail();
    }

    // 로그인하려는 사용자에 대한 정보를 user_info 변수에 저장한다
    $user_info = mysqli_fetch_array($result);
    // 그 중 비밀번호만 별도로 변수에 저장한다
    $hash_pw = $user_info['password'];

    mysqli_close($db_connection);

    if (password_verify($user_pw, $hash_pw)) {
        // 로그인 성공
        session_start();
        $_SESSION['user_id'] = $user_info['id'];

        echo "
            <script>
                alert('로그인 성공');
                location.href='main.php';
            </script>
        ";
    } else {
        // 로그인 실패
        login_fail();
    }
?>