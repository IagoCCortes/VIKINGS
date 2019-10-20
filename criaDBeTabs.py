import mysql.connector
import pandas as pd

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="teste0209",
  database="vikings"
)

mycursor = mydb.cursor()

mycursor.execute("CREATE DATABASE IF NOT EXISTS VIKINGS")

mycursor.execute("CREATE TABLE IF NOT EXISTS CARTORIOS \
                  (COD INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, \
                  NOME VARCHAR(255) NOT NULL, \
                  RAZAO VARCHAR(255) NOT NULL, \
                  DOCUMENTO BIGINT UNSIGNED NOT NULL, \
                  CEP VARCHAR(8) NOT NULL, \
                  ENDERECO VARCHAR(255) NOT NULL, \
                  BAIRRO VARCHAR(255) NOT NULL, \
                  CIDADE VARCHAR(255) NOT NULL, \
                  UF VARCHAR(2) NOT NULL, \
                  TELEFONE VARCHAR(20), \
                  EMAIL VARCHAR(255), \
                  TABELIAO VARCHAR(255), \
                  ATIVO TINYINT UNSIGNED NOT NULL, \
                  CRIADO_EM TIMESTAMP DEFAULT CURRENT_TIMESTAMP, \
                  ATUALIZADO_EM TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)")

#cria o data frame 'df' a partir da planilha do excel(Cartórios.xlsx)                 
df = pd.read_excel('Cartórios.xlsx', sheet_name='Table1')

df['DOCUMENTO'] = pd.to_numeric(df['DOCUMENTO'].astype(str).str.lstrip('0'))

df['ATIVO'] = [1 if i == 'SIM' else 0 for i in df['ATIVO']]

df = df.where((pd.notnull(df)), None)

#itera sobre as linhas do dataframe df e insere os elementos dessas no bd
for index, row in df.iterrows():
    print(row)
    mycursor.execute("INSERT INTO CARTORIOS \
                      (NOME, RAZAO, DOCUMENTO, CEP, ENDERECO, BAIRRO, CIDADE, UF, TELEFONE, EMAIL, TABELIAO, ATIVO) \
                      VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", tuple(row))
                      
    mydb.commit()
    
#fecha coneccao ao banco de dados
mycursor.close()


