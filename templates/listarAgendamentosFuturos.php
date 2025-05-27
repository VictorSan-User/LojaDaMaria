<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Agendamentos Futuros</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-5">
    <h1 class="mb-4 text-center">Agendamentos a Ocorrer</h1>

    <div id="lista-futuros" class="d-flex flex-column align-items-center"></div>

    <a href="meuNegocio.php" class="btn btn-secondary d-block mx-auto mt-3">Voltar</a>
  </div>

  <script>
  document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('lista-futuros');

    fetch('../Controllers/ControllerListagemFuturos.php')
      .then(res => {
        if (!res.ok) throw new Error('Erro ao carregar agendamentos');
        return res.json();
      })
      .then(data => {
        container.innerHTML = '';
        if (data.length === 0) {
          container.innerHTML = '<p>Nenhum agendamento futuro encontrado.</p>';
          return;
        }
        data.forEach(item => {
          const card = document.createElement('div');
          card.className = 'card shadow-sm mb-3';
          card.style.maxWidth = '600px';
          card.style.width = '100%';
          card.innerHTML = `
            <div class="card-body">
              <h5 class="card-title">${item.titulo}</h5>
              <h6 class="card-subtitle mb-2 text-muted">Cliente: ${item.cliente}</h6>
              <p class="card-text">${item.descricao}</p>
              <p class="card-text"><small class="text-muted">
                Início: ${item.data_inicial} | Fim: ${item.data_final}
              </small></p>
              <a href="editarAgendamento.html?id=${item.id}" class="btn btn-primary btn-sm me-2">Editar</a>
              <button class="btn btn-danger btn-sm btn-excluir" data-id="${item.id}">Excluir</button>
            </div>`;
          container.appendChild(card);
        });
      })
      .catch(err => {
        container.innerHTML = `<p style="color:red;">${err.message}</p>`;
        console.error(err);
      });

    container.addEventListener('click', e => {
      if (e.target.classList.contains('btn-excluir')) {
        const id = e.target.dataset.id;
        if (confirm('Quer mesmo excluir esse agendamento?')) {
          fetch(`../Controllers/ControllerExcluirAgendamentos.php?id=${id}`, { method: 'POST' })
            .then(res => res.text())
            .then(msg => {
              alert(msg);
              location.reload();
            })
            .catch(err => alert('Erro ao excluir: ' + err));
        }
      }
    });
  });
  </script>
</body>
</html>
