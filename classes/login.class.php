<?php 

	class Login Extends Conexao{
		//private $email;
		//private $password;

		public function Logar (){
			$pdo = $this->Connect();
			
			ob_start();
			$logar = filter_input(INPUT_POST,'entrar', FILTER_SANITIZE_STRING);//verifica se foi clicado em cadastar
			if ($logar) {
				$recebeLog = filter_input_array(INPUT_POST, FILTER_DEFAULT);//$dadosRecebidos recebe os valores digitados e coloca num 
				//var_dump($recebeLog);
				$erro = false;
				$login = array_map('strip_tags', $recebeLog);//Se for digitado alguma tag a mesma será retirada
				if (in_array('', $login)) {
					//$erro = true;
					$_SESSION['menssagem'] = "Você deixou algum campo vazio!";
					header("location:login.php");
				}
				$senhaCod = md5($login['senha']);
				$vLogin = "select email, senha from admin where binary email = :email";
				$stmt = $pdo->prepare($vLogin);
				$stmt->bindParam(":email", $login['email']);
				$stmt->execute();

				$user = $stmt->fetchObject();
				if ($user) {
					if ($senhaCod == $user->senha) {
						header("Location:index.php");
						$_SESSION['logado'] = true;
					}
					else{
						$_SESSION['menssagem'] = " Senha incorreta. Tente novamente";
						header("location:login.php");
					}
				}
				elseif(!in_array('', $login)){
					$_SESSION['menssagem'] = "Email ou senha incorretos.";
					header("location:login.php");
				}
			}
		}
		public function VerificaLogin(){
			session_start();
			if(!$_SESSION['logado']) {
				header('Location: login.php');
				exit();
			}
		}
		public function Logout(){
			session_start();
			if (isset($_SESSION["logado"])) {
				session_destroy();
				header("location:login.php");
			}
		}
	}
?>
