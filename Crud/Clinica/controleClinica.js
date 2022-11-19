function updateButtons(select){
    const btnEnviar = document.getElementById('btnEnviar')
    const btnAtualizar = document.getElementById('btnAtualizar')
    const btnDeletar = document.getElementById('btnDeletar')
    const clin_Nome = document.getElementById('clin_Nome')
    const clin_Telefone = document.getElementById('clin_Telefone')
    const clin_Endereco = document.getElementById('clin_Endereco')

    if(select.value != ""){
        btnEnviar.disabled = true
        btnAtualizar.disabled = false
        btnDeletar.disabled = false

        preencherCampos(select.value)
    }else{
        btnEnviar.disabled = false
        btnAtualizar.disabled = true
        btnDeletar.disabled = true

        clin_Nome.value = ""
        clin_Telefone.value = ""
        clin_Endereco.value = ""
    }
}

function preencherCampos(id){
    let dadosString = document.getElementById('dadosString').innerText
    let dadosArray = []
    const clin_Nome = document.getElementById('clin_Nome')
    const clin_Telefone = document.getElementById('clin_Telefone')
    const clin_Endereco = document.getElementById('clin_Endereco')

    dadosString.split('|').forEach(function(dado){
        dadosArray.push(dado.split(';'))
    })

    let reg_selecionado = dadosArray.find(it => it.includes(`clin_Id:'${id}'`))

    console.log(reg_selecionado)

    clin_Nome.value = reg_selecionado.find(it => it.split(':')[0] == 'clin_Nome').split(':')[1].replaceAll("'","")
    clin_Telefone.value = reg_selecionado.find(it => it.split(':')[0] == 'clin_Telefone').split(':')[1].replaceAll("'","")
    clin_Endereco.value = reg_selecionado.find(it => it.split(':')[0] == 'clin_Endereco').split(':')[1].replaceAll("'","")
}