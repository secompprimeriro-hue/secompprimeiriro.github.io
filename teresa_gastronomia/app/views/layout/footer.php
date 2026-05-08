    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Data atual no footer
        document.addEventListener('DOMContentLoaded', function() {
            const ano = new Date().getFullYear();
            const footerText = document.querySelector('footer p');
            if(footerText) {
                footerText.innerHTML = `&copy; ${ano} Grupo Tereza Gastronomia. Todos os direitos reservados.`;
            }
        });
    </script>
</body>
</html>