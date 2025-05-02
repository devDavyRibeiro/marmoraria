		function abrirAlerta(){
			Swal.fire({
			title: 'Sucesso!',
			text: 'Operação realizada com sucesso!',
			icon: 'success'
			}).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '../index.php'; // Redireciona para a página "index.php"
        }
    });
		}
		function abrirErro(){
			Swal.fire({
			title: 'Eita...',
			text: 'Algo deu errado!',
			icon: 'error'
			}).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '../index.php'; // Redireciona para a página "index.php"
        }
    });
		}	
		function abrirLogin(){
			Swal.fire({
			title: 'Não reconhecido!',
			text: 'Email ou senha incorretos',
			icon: 'warning'
			}).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '../index.php'; // Redireciona para a página "index.php"
        }
    });
		}