<?php
// Database connection parameters
$host = 'localhost';
$user = 'root';
$pass = '';

try {
    // Create connection without database selected
    $pdo = new PDO("mysql:host=$host", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Conectado exitosamente a MySQL\n";
    
    // Read and execute SQL file
    $sql = file_get_contents('database.sql');
    
    // Execute multiple statements
    $pdo->exec($sql);
    
    echo "Base de datos y tablas creadas exitosamente\n";
    echo "Usuario admin creado con contraseña: admin123\n";
    
} catch(PDOException $e) {
    die("Error: " . $e->getMessage() . "\n");
}

// Create assets directories
$directories = [
    'assets',
    'assets/css',
    'assets/js',
    'assets/images'
];

foreach ($directories as $dir) {
    if (!file_exists($dir)) {
        mkdir($dir, 0777, true);
        echo "Directorio '$dir' creado exitosamente\n";
    }
}

// Create custom CSS file
$css_content = "/* Custom styles for Inventario ITEVO */
.custom-scrollbar::-webkit-scrollbar {
    width: 6px;
    height: 6px;
}

.custom-scrollbar::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 3px;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: #555;
}

/* Custom animations */
.fade-in {
    animation: fadeIn 0.3s ease-in;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

/* Custom transitions */
.smooth-transition {
    transition: all 0.3s ease-in-out;
}

/* Custom shadows */
.custom-shadow {
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
}

.custom-shadow-hover:hover {
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
}

/* Form styles */
.form-input-focus:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

/* Table styles */
.table-hover tr:hover {
    background-color: rgba(59, 130, 246, 0.05);
}

/* Card styles */
.card-hover:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
}

/* Button styles */
.btn-primary {
    @apply bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200;
}

.btn-secondary {
    @apply bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors duration-200;
}

.btn-success {
    @apply bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors duration-200;
}

.btn-danger {
    @apply bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors duration-200;
}

/* Alert styles */
.alert {
    @apply p-4 mb-4 rounded-lg;
}

.alert-success {
    @apply bg-green-100 text-green-700 border border-green-400;
}

.alert-error {
    @apply bg-red-100 text-red-700 border border-red-400;
}

.alert-warning {
    @apply bg-yellow-100 text-yellow-700 border border-yellow-400;
}

.alert-info {
    @apply bg-blue-100 text-blue-700 border border-blue-400;
}

/* Modal styles */
.modal-overlay {
    @apply fixed inset-0 bg-black bg-opacity-50 z-40;
}

.modal-container {
    @apply fixed inset-0 z-50 flex items-center justify-center p-4;
}

.modal-content {
    @apply bg-white rounded-lg shadow-xl max-w-md w-full mx-auto;
}

/* Loading spinner */
.spinner {
    border: 3px solid rgba(0, 0, 0, 0.1);
    border-radius: 50%;
    border-top: 3px solid #3b82f6;
    width: 24px;
    height: 24px;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}";

file_put_contents('assets/css/style.css', $css_content);
echo "Archivo CSS personalizado creado exitosamente\n";

// Create custom JS file
$js_content = "// Custom JavaScript functions for Inventario ITEVO

// Format currency
function formatCurrency(amount) {
    return new Intl.NumberFormat('es-MX', {
        style: 'currency',
        currency: 'MXN'
    }).format(amount);
}

// Format date
function formatDate(date) {
    return new Intl.DateTimeFormat('es-MX', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    }).format(new Date(date));
}

// Show toast notification
function showToast(message, type = 'success') {
    const toast = document.createElement('div');
    let bgColor = 'bg-blue-500';
    
    if (type === 'success') {
        bgColor = 'bg-green-500';
    } else if (type === 'error') {
        bgColor = 'bg-red-500';
    }
    
    toast.className = `fixed bottom-4 right-4 px-6 py-3 rounded-lg shadow-lg ${bgColor} text-white z-50 fade-in`;
    toast.textContent = message;
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.remove();
    }, 3000);
}

// Confirm action
function confirmAction(message) {
    return new Promise((resolve) => {
        const modal = document.createElement('div');
        modal.className = 'modal-overlay';
        modal.innerHTML = `
            <div class='modal-container'>
                <div class='modal-content p-6'>
                    <h3 class='text-lg font-medium mb-4'>Confirmar Acción</h3>
                    <p class='text-gray-600 mb-6'>${message}</p>
                    <div class='flex justify-end space-x-3'>
                        <button class='btn-secondary' onclick='this.closest(\".modal-overlay\").remove(); resolve(false);'>
                            Cancelar
                        </button>
                        <button class='btn-danger' onclick='this.closest(\".modal-overlay\").remove(); resolve(true);'>
                            Confirmar
                        </button>
                    </div>
                </div>
            </div>
        `;
        document.body.appendChild(modal);
    });
}

// Handle form submission with AJAX
function handleFormSubmit(formElement, successCallback) {
    formElement.addEventListener('submit', async (e) => {
        e.preventDefault();
        
        try {
            const formData = new FormData(formElement);
            const response = await fetch(formElement.action, {
                method: formElement.method,
                body: formData
            });
            
            const result = await response.json();
            
            if (result.success) {
                showToast(result.message || 'Operación exitosa', 'success');
                if (successCallback) successCallback(result);
            } else {
                showToast(result.message || 'Error en la operación', 'error');
            }
        } catch (error) {
            showToast('Error al procesar la solicitud', 'error');
            console.error('Error:', error);
        }
    });
}

// Initialize tooltips
function initTooltips() {
    const tooltips = document.querySelectorAll('[data-tooltip]');
    tooltips.forEach(element => {
        element.addEventListener('mouseenter', e => {
            const tooltip = document.createElement('div');
            tooltip.className = 'absolute z-50 px-2 py-1 text-sm text-white bg-gray-900 rounded shadow-lg';
            tooltip.textContent = element.getAttribute('data-tooltip');
            tooltip.style.top = `${e.target.offsetTop - 30}px`;
            tooltip.style.left = `${e.target.offsetLeft + (e.target.offsetWidth / 2)}px`;
            tooltip.style.transform = 'translateX(-50%)';
            document.body.appendChild(tooltip);
            
            element.addEventListener('mouseleave', () => tooltip.remove());
        });
    });
}

// Initialize all interactive elements
document.addEventListener('DOMContentLoaded', () => {
    initTooltips();
});";

file_put_contents('assets/js/script.js', $js_content);
echo "Archivo JavaScript personalizado creado exitosamente\n";

echo "\nInicialización completada exitosamente!\n";
echo "Puede acceder al sistema usando:\n";
echo "Usuario: admin\n";
echo "Contraseña: admin123\n";
?>