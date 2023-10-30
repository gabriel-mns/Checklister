var contador = 0;

function adicionarNovoChecklistItem() {
    const template = `
        <div class="container-checklist-item">
            <div class="mb-3">
                <label for="descricao${contador}" class="form-label input_text_form-label">Descrição: </label>
                <input type="text" class="form-control" id="descricao${contador}" name="descricao${contador}">
            </div>

            <div class="mb-3">
                <label for="nomeResponsavelCorrecao${contador}" class="form-label input_text_form-label">Nome do responsável pela correção: </label>
                <input type="text" class="form-control" id="nomeResponsavelCorrecao${contador}" name="nomeResponsavelCorrecao${contador}">
            </div>


            <div class="mb-3">
                <label for="gravidade0" class="form-label">Gravidade da não-conformidade:</label>
                <select class="form-select" name="gravidade0" id="gravidade0">
                    <option value="1">Baixa</option>
                    <option value="2">Média</option>
                    <option value="3"selected>Alta</option>
                </select>
            </div>

            
            <div class="mb-3">
                <label for="prazoDias0" class="form-label">Gravidade da não-conformidade:</label>
                <input class="form-control" type="number" name="prazoDias0" id="prazoDias0" step=1>
            </div>
        </div>
    `;

    const element = document.createElement("div");

    element.innerHTML = template;

    const divInsercao = document.getElementById('div-insercao');

    divInsercao.appendChild(element);

    contador++;
}