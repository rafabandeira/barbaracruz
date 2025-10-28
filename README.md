# Tema WordPress: Barbara Cruz

Tema WordPress customizado, desenvolvido sob medida para o site de Barbara Cruz. O tema é focado em performance e gerenciamento de conteúdo modularizado através de Custom Post Types (CPTs) e páginas de opções nativas (Settings API), removendo dependências desnecessárias do Customizer para o conteúdo principal.

---

## 🚀 Funcionalidades Principais

* **Design Responsivo**: Baseado em Bootstrap 5.
* **Gerenciamento de Conteúdo Centralizado**: Seções principais (Hero, "Quem eu sou", Rodapé) são gerenciadas via páginas de opções no painel, não pelo Customizer.
* **Tipos de Post Customizados (CPTs)**: Para Serviços, Depoimentos e Mosaico de Fotos.
* **Painel Administrativo Limpo**: O painel é modificado para exibir apenas os menus essenciais para o cliente, incluindo um widget de "Guia Rápido".
* **Atualizador Customizado**: O tema verifica atualizações a partir de um arquivo JSON hospedado externamente (GitHub).

---

## 🧩 Estrutura de Conteúdo

O tema é estruturado em torno de CPTs e Páginas de Opções para facilitar a gestão pelo cliente.

### 1. Tipos de Post Customizados (CPTs)

* **Serviços (`servicos`)**
    * Utilizado para gerenciar os serviços oferecidos.
    * Suporta: Título, Editor de Bloco (Descrição), Imagem Destacada e Resumo.
    * **Metaboxes Customizados**:
        * `Subtítulo`: Um subtítulo opcional para o serviço.
        * `Ordem de Exibição`: (Numérico) Usado para ordenação customizada no frontend.
        * `Cor de Fundo`: (Dropdown) Define a classe de fundo (`bg-dourado`, `bg-terracota`, `bg-areia`).

* **Depoimentos (`depoimentos`)**
    * Utilizado para gerenciar os depoimentos de clientes.
    * Suporta: Título (Nome do Cliente) e Editor de Bloco (Texto do Depoimento).

* **Mosaico de Fotos (`mosaico_fotos`)**
    * Utilizado para alimentar a galeria/mosaico de fotos.
    * Suporta: Título (para referência) e Imagem Destacada (a foto).

### 2. Páginas de Opções (Settings API)

O conteúdo global do site é gerenciado em dois menus principais no painel:

* **AbertURA do Site (Menu Posição 4)**
    * **Seção Hero**: Gerencia o conteúdo da seção de abertura (Hero).
        * Imagem de Fundo
        * Título
        * Texto
    * **Configurações do Rodapé**: Gerencia as informações de contato no rodapé.
        * Telefone
        * Instagram
        * Email

* **Quem eu sou (Menu Posição 5)**
    * Gerencia o conteúdo da seção "Sobre" (Qui suis-je).
        * Título
        * Imagem
        * Texto (utiliza o `wp_editor`)

### 3. Configurações Nativas do WordPress

* **Logo do Site**:
    * Gerenciado via `Aparência > Personalizar > Identidade do Site`.
    * Utiliza a função nativa `add_theme_support('custom-logo')`.

* **Menu Principal**:
    * Gerenciado via `Aparência > Menus`.
    * A localização de menu registrada é `primary` (Menu Principal).

---

## 🛠️ Modificações do Painel (Admin)

* **Menus Removidos**: "Páginas" e "Comentários" são removidos para simplificar a interface.
* **Menus Reordenados**: "Posts" e "Mídia" são movidos para o final da lista (prioridade 9 e 10).
* **Widget Customizado**: Um widget "Guia Rápido do Site" é adicionado ao painel principal com links diretos para as áreas de gerenciamento (CPTs e Páginas de Opções).
* **Limpeza de Widgets**: Widgets padrão do WordPress (Bem-vindo, Atividade, Saúde do Site, etc.) são removidos.