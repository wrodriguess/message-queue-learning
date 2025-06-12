CRIAR (POST /tasks)
LER (GET /tasks , GET /tasks?id=14&status=pending)
    - BUSCAR TODOS
    - BUSCAR POR ID
    - FILTRAR POR GRUPO
    - STATUS
    - ATRASADOS
    - ORDENAÇÃO
    - PAGINAÇÃO
ATUALIZAR (PUT /tasks/{id})
DELETAR (DELETE /tasks/{id})
CONCLUIR (PATCH /tasks/{id})

- id
- uuid
- user_id
- title
- description
- status_id (pending, completed, in_progress, cancelled)
- due_date
- priority (enum: low, medium, hight)
- category
- created_at
- updated_at
- deleted_at

---

# DÚVIDAS

1. Por que em meu DTO eu não posso deixar os atributos como "public"?
Se logo após irei fazer o getter dele? o problema é ser public para escrita?
2. Parametros opcionais no construtor devem ficar sempre por último?
3. Por que precisa ter linha em branco no final da classe?
4. Sempre preciso de um construtor? mesmo que não tenha nenhum parametor para passar para ele?
5. Por que utilizar DateTimeImmutable?










# JUNHO - 3 SEMANAS
DÍVIDA R$1182
1.68 SEMANAS DE TRABALHO

# JULHO - 4 SEMANAS
DÍVIDA R$2.900
4.14 SEMANAS DE TRABALHO

5.82 SEMANAS DE TRABALHO
7 SEMANAS DISPONIVEIS

# AGOSTO - 4 SEMANAS
DÍVIDA R$2.313,93
3.30 SEMANAS DE TRABALHO

9.12 SEMANAS DE TRABALHO
11 SEMANAS DISPONIVEIS

# SETEMBRO A DEZEMBRO 
DÍVIDA R$1.000 
1 SEMANA DE TRABALHO













