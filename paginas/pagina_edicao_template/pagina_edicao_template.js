
function adicionarNovoChecklistItem() {
    
    var contador = parseInt(document.getElementById("lastChecklistItem").value);

    const template = `
        <div class="container-checklist-item mb-3">
            <div class="mb-3">
                <label for="descricao${contador}" class="form-label input_text_form-label">Descrição: </label>
                <input type="text" class="form-control" id="descricao${contador}" name="descricao${contador}" required>
            </div>

            <div class="mb-3">
                <label for="nomeResponsavelCorrecao${contador}" class="form-label input_text_form-label">Nome do responsável pela correção: </label>
                <input type="text" class="form-control" id="nomeResponsavelCorrecao${contador}" name="nomeResponsavelCorrecao${contador}" required>
            </div>


            <div class="mb-3">
                <label for="gravidade${contador}" class="form-label">Gravidade da não-conformidade:</label>
                <select class="form-select" name="gravidade${contador}" id="gravidade${contador}" required>
                    <option value="Baixa">Baixa</option>
                    <option value="Média">Média</option>
                    <option value="selected"selected>Alta</option>
                </select>
            </div>

            
            <div class="mb-3">
                <label for="prazoDias${contador}" class="form-label">Prazo em dias para atender a não-conformidade:</label>
                <input class="form-control" type="number" name="prazoDias${contador}" id="prazoDias${contador}" step=1 required>
            </div>
        </div>
    `;

    const element = document.createElement("div");

    element.innerHTML = template;

    const divInsercao = document.getElementById('div-insercao');

    divInsercao.appendChild(element);

    contador++;
}