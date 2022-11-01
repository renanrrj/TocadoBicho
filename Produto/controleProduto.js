function updateButtons(select) {
    const btnEnviar = document.getElementById('btnEnviar')
    const btnAtualizar = document.getElementById('btnAtualizar')
    const btnDeletar = document.getElementById('btnDeletar')
    const pro_Id_Categoria = document.getElementById('pro_Id_Categoria')
    const pro_Nome = document.getElementById('pro_Nome')
    const pro_Preco = document.getElementById('pro_Preco')
    const pro_Detalhe = document.getElementById('pro_Detalhe')

    if (select.value != "") {
        btnEnviar.disabled = true
        btnAtualizar.disabled = false
        btnDeletar.disabled = false

        preencherCampos(select.value)
    } else {
        btnEnviar.disabled = false
        btnAtualizar.disabled = true
        btnDeletar.disabled = true

        pro_Id_Categoria.value = 1
        pro_Nome.value = ""
        pro_Preco.value = ""
        pro_Detalhe.value = ""
    }
}

function preencherCampos(id){
    let dadosString = document.getElementById('dadosString').innerText
    let dadosArray = []
    const pro_Nome = document.getElementById('pro_Nome')
    const pro_Preco = document.getElementById('pro_Preco')
    const pro_Id_Categoria = document.getElementById('pro_Id_Categoria') 
    const pro_Detalhe = document.getElementById('pro_Detalhe') 

    dadosString.split('/').forEach(function(dado){
        dadosArray.push(dado.split(';'))
    })

    let reg_selecionado = dadosArray.find(it => it.includes(`pro_Id:'${id}'`))

    console.log(reg_selecionado)

    pro_Nome.value = reg_selecionado.find(it => it.split(':')[0] == 'pro_Nome').split(':')[1].replaceAll("'","")
    pro_Preco.value = reg_selecionado.find(it => it.split(':')[0] == 'pro_Preco').split(':')[1].replaceAll("'","")
    pro_Id_Categoria.value = reg_selecionado.find(it => it.split(':')[0] == 'pro_Id_Categoria').split(':')[1].replaceAll("'","")
    pro_Detalhe.value = reg_selecionado.find(it => it.split(':')[0] == 'pro_Detalhe').split(':')[1].replaceAll("'","")

    //';:/ não pode ser nome de tabela
}