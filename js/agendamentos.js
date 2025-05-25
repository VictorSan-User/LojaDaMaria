document.addEventListener('DOMContentLoaded', () => {
  const container = document.getElementById('lista-futuros');

  function carregarAgendamentos() {
    fetch('../Controllers/ControllerListagemFuturos.php') 
      .then(response => {
        if(!response.ok) throw new Error('Erro ao carregar agendamentos');
        return response.json();
      })
      .then(data => {
        container.innerHTML = '';
        if(data.length === 0){
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
              <p class="card-text"><small class="text-muted">Início: ${item.data_inicial} | Fim: ${item.data_final}</small></p>
              <a href="editarAgendamento.html?id=${item.id}" class="btn btn-primary btn-sm me-2">Editar</a>
              <button class="btn btn-danger btn-sm btn-excluir" data-id="${item.id}">Excluir</button>
            </div>
          `;

          container.appendChild(card);
        });
      })
      .catch(err => {
        container.innerHTML = `<p style="color:red;">${err.message}</p>`;
        console.error(err);
      });
  }

  container.addEventListener('click', e => {
    if(e.target.classList.contains('btn-excluir')){
      const id = e.target.getAttribute('data-id');
      if(confirm('Quer mesmo excluir esse agendamento?')){
        fetch(`../Controllers/ControllerExcluirAgendamentos.php.php?id=${id}`, { method: 'POST' })
          .then(res => res.text())
          .then(msg => {
            alert(msg);
            carregarAgendamentos();
          })
          .catch(err => alert('Erro ao excluir: ' + err));
      }
    }
  });
  function buscarAgendamentoPorId(id) {
  fetch(`../Controllers/ControllerBuscarAgendamento.php?id=${id}`)
    .then(res => {
      if (!res.ok) throw new Error('Agendamento não encontrado');
      return res.json();
    })
    .then(data => {
      const container = document.getElementById('resultado-busca');
      container.innerHTML = `
        <div class="card shadow-sm mb-3" style="max-width:600px; width:100%;">
          <div class="card-body">
            <h5 class="card-title">${data.titulo}</h5>
            <h6 class="card-subtitle mb-2 text-muted">Cliente: ${data.cliente}</h6>
            <p class="card-text">${data.descricao}</p>
            <p class="card-text"><small class="text-muted">Início: ${data.data_inicial} | Fim: ${data.data_final}</small></p>
          </div>
        </div>
      `;
    })
    .catch(err => {
      alert(err.message);
    });
}


  // Carrega a lista assim que o DOM estiver pronto
  carregarAgendamentos();
});
