<?php
session_start();
//print_r($_REQUEST);
if(isset($_POST['submit']) && !empty($_POST['email'])
&& !empty($_POST['senha']) && !empty($_POST['tipo'])){
    //deixa acessar o sistema
    include_once('config.php');
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $tipo = $_POST['tipo'];
    /*print_r('Email: '.$email);
    print_r('<br>');
    print_r('Senha: '.$senha);*/
    $sql = "SELECT * FROM usuarios WHERE email = '$email' and senha = '$senha' and tipo = '$tipo'";
    #verifica se a senha e email é igual ao do banco de dados
    $result = $conexao->query($sql); #manda executar no banco de dados
    //print_r($result);
    //print_r($sql);
    if(mysqli_num_rows($result) < 1){
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        unset($_SESSION['tipo']);
        header('login.php');
    }elseif(mysqli_num_rows($result) >= 1 and $tipo == 'admin'){
        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;
        header('Location: sistema.php');
    }else{
        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;
        $_SESSION['tipo'] == 'usuario';
        header('Location: sistema_usuario.php');
    }
}
else{
    //não deixa acessar
    header('Location: login.php');
}
?>