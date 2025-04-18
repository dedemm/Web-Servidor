<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cadastro e Reserva de Carros</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>

  <header>
    <h1>Sistema de Cadastro e Reserva de Carros</h1>
  </header>

  <nav>
    <a href="#">Início</a>
    <a href="#">Cadastro</a>
    <a href="#">Reserva</a>
    <a href="#">Listagem</a>
  </nav>

  <main>
    <section id="cadastro">
      <h2>Cadastro de Carro</h2>
      <form>
        <label for="modelo">Modelo</label>
        <input type="text" id="modelo" name="modelo" placeholder="Ex: Fiat Uno">

        <label for="marca">Marca</label>
        <input type="text" id="marca" name="marca" placeholder="Ex: Fiat">

        <label for="ano">Ano</label>
        <input type="number" id="ano" name="ano" placeholder="Ex: 2020">

        <label for="placa">Placa</label>
        <input type="text" id="placa" name="placa" placeholder="Ex: ABC-1234">

        <label for="descricao">Descrição</label>
        <textarea id="descricao" name="descricao" rows="4" placeholder="Algum detalhe do carro..."></textarea>

        <button type="submit">Cadastrar Carro</button>
      </form>
    </section>

    <hr style="margin: 2rem 0;">

    <section id="reserva">
      <h2>Reserva de Carro</h2>
      <form>
        <label for="cliente">Nome do Cliente</label>
        <input type="text" id="cliente" name="cliente" placeholder="Seu nome completo">

        <label for="carro">Carro</label>
        <select id="carro" name="carro">
          <option selected disabled>Selecione um carro</option>
          <option>Fiat Uno - ABC1234</option>
          <option>Honda Civic - XYZ9876</option>
        </select>

        <label for="dataInicio">Data de Início</label>
        <input type="date" id="dataInicio" name="dataInicio">

        <label for="dataFim">Data de Fim</label>
        <input type="date" id="dataFim" name="dataFim">

        <button type="submit">Reservar Carro</button>
      </form>
    </section>

    <section class="car-list">
      <h2>Lista de Carros Cadastrados</h2>
      <div class="car-card">
        <strong>Modelo:</strong> Fiat Uno<br>
        <strong>Marca:</strong> Fiat<br>
        <strong>Ano:</strong> 2020<br>
        <strong>Placa:</strong> ABC-1234
      </div>
      <div class="car-card">
        <strong>Modelo:</strong> Honda Civic<br>
        <strong>Marca:</strong> Honda<br>
        <strong>Ano:</strong> 2022<br>
        <strong>Placa:</strong> XYZ-9876
      </div>
    </section>
  </main>

</body>
</html>
