document.getElementById('brokerForm').addEventListener('submit', function(event) {
    const cpf = document.querySelector('input[name="cpf"]');
    const creci = document.querySelector('input[name="creci"]');
    const nome = document.querySelector('input[name="nome"]');

    // Validação de CPF
    const cpfRegex = /^\d{11}$/;
    if (!cpfRegex.test(cpf.value)) {
        alert('CPF deve conter exatamente 11 dígitos numéricos');
        event.preventDefault();
        return;
    }

    // Validação de Creci
    if (creci.value.trim().length < 2) {
        alert('Creci deve ter pelo menos 2 caracteres');
        event.preventDefault();
        return;
    }

    // Validação de Nome
    if (nome.value.trim().length < 2) {
        alert('Nome deve ter pelo menos 2 caracteres');
        event.preventDefault();
        return;
    }
});

function deleteBroker(id) {
    if (confirm('Tem certeza que deseja excluir este corretor?')) {
        window.location.href = 'delete.php?id=' + id;
    }
}

function editBroker(id) {
    window.location.href = 'editar.php?id=' + id;
}
