<?php
$page_title = "Bem-vindo ao Portal Cibersegurança"; // Define o título da página
require_once 'includes/header.php'; // Inclui o cabeçalho
?>

<div class="p-5 mb-4 bg-light rounded-3">
  <div class="container-fluid py-5">
    <h1 class="display-5 fw-bold">Proteja-se no Mundo Digital</h1>
    <p class="col-md-8 fs-4">Aprenda sobre as principais ameaças cibernéticas e como se defender delas. Conhecimento é a sua melhor defesa.</p>
    <a href="/register.php" class="btn btn-primary btn-lg" type="button">Crie sua conta</a>
    <a href="#threats" class="btn btn-outline-secondary btn-lg ms-2" type="button">Ver Ameaças</a>
  </div>
</div>

<section id="threats" class="my-5">
  <h2 class="text-center mb-4">Principais Ameaças</h2>
  <div class="row text-center">
    <div class="col-md-4 mb-3">
      <div class="card h-100">
        <div class="card-body">
           <i class="bi bi-bug-fill fs-1 text-danger mb-3"></i> <h5 class="card-title">Malware</h5>
           <p class="card-text">Software malicioso projetado para danificar ou obter acesso não autorizado a sistemas.</p>
           <a href="#" class="btn btn-sm btn-outline-primary">Saiba mais</a> </div>
      </div>
    </div>
     <div class="col-md-4 mb-3">
      <div class="card h-100">
        <div class="card-body">
           <i class="bi bi-person-fill-exclamation fs-1 text-warning mb-3"></i> <h5 class="card-title">Phishing</h5>
           <p class="card-text">Tentativas fraudulentas de obter informações sensíveis disfarçando-se de entidade confiável.</p>
           <a href="#" class="btn btn-sm btn-outline-primary">Saiba mais</a>
        </div>
      </div>
    </div>
     <div class="col-md-4 mb-3">
      <div class="card h-100">
        <div class="card-body">
           <i class="bi bi-file-earmark-lock2-fill fs-1 text-info mb-3"></i> <h5 class="card-title">Ransomware</h5>
           <p class="card-text">Tipo de malware que criptografa arquivos e exige pagamento para restaurar o acesso.</p>
           <a href="#" class="btn btn-sm btn-outline-primary">Saiba mais</a>
        </div>
      </div>
    </div>
    </div>
</section>

<?php
require_once 'includes/footer.php'; // Inclui o rodapé
?>