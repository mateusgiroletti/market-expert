# Use uma imagem leve do Node.js como base
FROM node:alpine

# Defina o diretório de trabalho no contêiner
WORKDIR /app

# Copie a pasta 'dist' com os arquivos compilados para o contêiner
COPY dist ./dist

# Instale um servidor HTTP simples para servir os arquivos
RUN npm install -g http-server

# Expõe a porta 80 para que o aplicativo possa ser acessado externamente
EXPOSE 3030

# Define o comando padrão para iniciar o servidor HTTP
CMD ["http-server", "-p", "3030", "./dist"]