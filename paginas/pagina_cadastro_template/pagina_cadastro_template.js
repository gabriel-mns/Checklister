var contador = 1;

function adicionarNovoChecklistItem() {
    const template = `
        <div class="container-checklist-item mb-3">
            <div class="mb-3">
                <label for="descricao${contador}" class="form-label input_text_form-label">Descrição: </label>
                <input type="text" class="form-control" id="descricao${contador}" name="descricao${contador}">
            </div>

            <div class="mb-3">
                <label for="nomeResponsavelCorrecao${contador}" class="form-label input_text_form-label">Nome do responsável pela correção: </label>
                <input type="text" class="form-control" id="nomeResponsavelCorrecao${contador}" name="nomeResponsavelCorrecao${contador}">
            </div>


            <div class="mb-3">
                <label for="gravidade${contador}" class="form-label">Gravidade da não-conformidade:</label>
                <select class="form-select" name="gravidade${contador}" id="gravidade${contador}">
                    <option value="1">Baixa</option>
                    <option value="2">Média</option>
                    <option value="3"selected>Alta</option>
                </select>
            </div>

            
            <div class="mb-3">
                <label for="prazoDias${contador}" class="form-label">Prazo em dias para atender a não-conformidade:</label>
                <input class="form-control" type="number" name="prazoDias${contador}" id="prazoDias${contador}" step=1>
            </div>
        </div>
    `;

    const element = document.createElement("div");

    element.innerHTML = template;

    const divInsercao = document.getElementById('div-insercao');

    divInsercao.appendChild(element);

    contador++;
}