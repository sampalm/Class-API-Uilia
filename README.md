# Class-API-Uilia
API class php para consumir, alterar e cadastrar dados na plataforma do uilia. Documentação: https://uilia.docs.apiary.io/

Exemplo:

```
require 'Uilia.class.php';  
$Uilia = new uiliaAPI;
  
// Listar todas categorias  
$Cat = $Uilia->get('categoria', '&limit=10');
  
// Selecionar categoria especifica com id = 10  
$Cat = $Uilia->get('categoria', '&id=10');
```
