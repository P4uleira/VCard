# 🎴 VCard — Sistema de Cartões Virtuais para Eventos

## 📌 Sobre o Projeto

O **VCard** é um sistema web que permite a criação e visualização de **cartões virtuais informativos** para eventos, reduzindo o uso de papel e facilitando a comunicação entre participantes, organizadores e visitantes.

Através dos cartões, os participantes podem apresentar seus projetos com:

* Imagem de destaque
* Descrição resumida e completa
* Informações de contato
* Estatísticas e metadados
* Botões de **curtida** ❤️ e **favorito** ⭐

Após criado, cada VCard gera um **QR Code único**, permitindo que o público acesse o conteúdo rapidamente, inclusive de forma anônima.

## 📌 Documentação do trabalho: 

[Documentação do Sistema VCards.pdf](https://github.com/user-attachments/files/23676681/Documentacao.do.Sistema.VCards.pdf)

---

## 🖼️ Exemplo de Card (Frente e Verso)

<img width="575" height="398" alt="image" src="https://github.com/user-attachments/assets/cd4d8f7a-7d10-43fc-b895-c559e32f1b3c" />

---

## ⚙️ Funcionamento do Sistema

### 👨‍💼 Organizador do Evento

* Tem seu cadastro criado por um administrador.
* Cria eventos e gera **chaves-convite** para participantes.
* Registra participantes/expositores do evento.
* Acompanha os cartões criados.
* Pode excluir eventos e todos os VCards vinculados.

---

### 👤 Participante / Expositor do Evento

* Tem cadastro criado pelo organizador.
* Cria e edita seu próprio VCard.
* Gera o QR Code do seu cartão.

---

### 👀 Visitante do Evento

* Acessa cartões através do QR Code **sem necessidade de login**.
* Pode se cadastrar na plataforma.
* Usuários cadastrados podem:

  * Visualizar mais cartões
  * Criar uma **coleção pessoal** de VCards
  * Favoritar cartões

---

### 🧾 Sobre os VCards

* Cada cartão deve possuir um **identificador único**.
* Deve existir um modo de visualização pública e modos de gestão.
* Todo VCard possui uma **URL própria**, correspondente ao QR Code.
* Visualização anônima deve oferecer opção de **LOGIN**.
* Visualização autenticada deve permitir **adicionar à coleção**.

---

### 🔎 Metadados Mínimos de Cada VCard

* Data de criação
* Proprietário
* Categoria
* Número de visualizações

Metadados podem possuir visibilidade configurável:

* **Visível** para visitantes
* **Oculto**

---

