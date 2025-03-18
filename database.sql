-- Tabla de Usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT UNIQUE NOT NULL,
    password TEXT NOT NULL,
    nombre TEXT NOT NULL,
    email TEXT UNIQUE NOT NULL,
    rol TEXT CHECK(rol IN ('admin', 'usuario', 'vendedor')) NOT NULL,
    estado TEXT DEFAULT 'activo' CHECK(estado IN ('activo', 'inactivo')),
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    ultima_modificacion DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de Categorías
CREATE TABLE IF NOT EXISTS categorias (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre TEXT NOT NULL,
    descripcion TEXT,
    estado TEXT DEFAULT 'activo' CHECK(estado IN ('activo', 'inactivo')),
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    ultima_modificacion DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de Almacenes
CREATE TABLE IF NOT EXISTS almacenes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre TEXT NOT NULL,
    ubicacion TEXT NOT NULL,
    responsable_id INTEGER,
    capacidad INTEGER,
    estado TEXT DEFAULT 'activo' CHECK(estado IN ('activo', 'inactivo')),
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    ultima_modificacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (responsable_id) REFERENCES usuarios(id)
);

-- Tabla de Productos
CREATE TABLE IF NOT EXISTS productos (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    codigo TEXT UNIQUE NOT NULL,
    nombre TEXT NOT NULL,
    descripcion TEXT,
    categoria_id INTEGER,
    precio_compra DECIMAL(10,2) NOT NULL,
    precio_venta DECIMAL(10,2) NOT NULL,
    stock_minimo INTEGER DEFAULT 0,
    estado TEXT DEFAULT 'activo' CHECK(estado IN ('activo', 'inactivo')),
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    ultima_modificacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id)
);

-- Tabla de Inventario (stock por almacén)
CREATE TABLE IF NOT EXISTS inventario (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    producto_id INTEGER NOT NULL,
    almacen_id INTEGER NOT NULL,
    cantidad INTEGER NOT NULL DEFAULT 0,
    ubicacion_almacen TEXT,
    fecha_actualizacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (producto_id) REFERENCES productos(id),
    FOREIGN KEY (almacen_id) REFERENCES almacenes(id),
    UNIQUE(producto_id, almacen_id)
);

-- Tabla de Clientes
CREATE TABLE IF NOT EXISTS clientes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre TEXT NOT NULL,
    documento_tipo TEXT CHECK(documento_tipo IN ('DNI', 'RUC', 'PASAPORTE')) NOT NULL,
    documento_numero TEXT NOT NULL,
    direccion TEXT,
    telefono TEXT,
    email TEXT,
    estado TEXT DEFAULT 'activo' CHECK(estado IN ('activo', 'inactivo')),
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    ultima_modificacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    UNIQUE(documento_tipo, documento_numero)
);

-- Tabla de Clientes Asociados
CREATE TABLE IF NOT EXISTS clientes_asociados (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    cliente_principal_id INTEGER NOT NULL,
    cliente_asociado_id INTEGER NOT NULL,
    tipo_relacion TEXT NOT NULL,
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (cliente_principal_id) REFERENCES clientes(id),
    FOREIGN KEY (cliente_asociado_id) REFERENCES clientes(id)
);

-- Tabla de Ventas
CREATE TABLE IF NOT EXISTS ventas (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    cliente_id INTEGER NOT NULL,
    usuario_id INTEGER NOT NULL,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    subtotal DECIMAL(10,2) NOT NULL,
    igv DECIMAL(10,2) NOT NULL,
    total DECIMAL(10,2) NOT NULL,
    estado TEXT DEFAULT 'pendiente' CHECK(estado IN ('pendiente', 'completada', 'cancelada')),
    tipo_pago TEXT CHECK(tipo_pago IN ('efectivo', 'tarjeta', 'transferencia')) NOT NULL,
    notas TEXT,
    FOREIGN KEY (cliente_id) REFERENCES clientes(id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- Tabla de Detalles de Ventas
CREATE TABLE IF NOT EXISTS ventas_detalle (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    venta_id INTEGER NOT NULL,
    producto_id INTEGER NOT NULL,
    cantidad INTEGER NOT NULL,
    precio_unitario DECIMAL(10,2) NOT NULL,
    subtotal DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (venta_id) REFERENCES ventas(id),
    FOREIGN KEY (producto_id) REFERENCES productos(id)
);

-- Tabla de Devoluciones
CREATE TABLE IF NOT EXISTS devoluciones (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    venta_id INTEGER NOT NULL,
    usuario_id INTEGER NOT NULL,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    motivo TEXT NOT NULL,
    estado TEXT DEFAULT 'pendiente' CHECK(estado IN ('pendiente', 'procesada', 'rechazada')),
    FOREIGN KEY (venta_id) REFERENCES ventas(id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- Tabla de Detalles de Devoluciones
CREATE TABLE IF NOT EXISTS devoluciones_detalle (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    devolucion_id INTEGER NOT NULL,
    producto_id INTEGER NOT NULL,
    cantidad INTEGER NOT NULL,
    motivo_detalle TEXT,
    FOREIGN KEY (devolucion_id) REFERENCES devoluciones(id),
    FOREIGN KEY (producto_id) REFERENCES productos(id)
);

-- Tabla de Transferencias
CREATE TABLE IF NOT EXISTS transferencias (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    almacen_origen_id INTEGER NOT NULL,
    almacen_destino_id INTEGER NOT NULL,
    usuario_id INTEGER NOT NULL,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    estado TEXT DEFAULT 'pendiente' CHECK(estado IN ('pendiente', 'en_transito', 'completada', 'cancelada')),
    notas TEXT,
    FOREIGN KEY (almacen_origen_id) REFERENCES almacenes(id),
    FOREIGN KEY (almacen_destino_id) REFERENCES almacenes(id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- Tabla de Detalles de Transferencias
CREATE TABLE IF NOT EXISTS transferencias_detalle (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    transferencia_id INTEGER NOT NULL,
    producto_id INTEGER NOT NULL,
    cantidad INTEGER NOT NULL,
    FOREIGN KEY (transferencia_id) REFERENCES transferencias(id),
    FOREIGN KEY (producto_id) REFERENCES productos(id)
);

-- Tabla de Cuentas por Cobrar
CREATE TABLE IF NOT EXISTS cuentas_por_cobrar (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    venta_id INTEGER NOT NULL,
    monto_total DECIMAL(10,2) NOT NULL,
    monto_pendiente DECIMAL(10,2) NOT NULL,
    fecha_vencimiento DATE NOT NULL,
    estado TEXT DEFAULT 'pendiente' CHECK(estado IN ('pendiente', 'parcial', 'pagada')),
    FOREIGN KEY (venta_id) REFERENCES ventas(id)
);

-- Tabla de Cuentas por Pagar
CREATE TABLE IF NOT EXISTS cuentas_por_pagar (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    proveedor TEXT NOT NULL,
    monto_total DECIMAL(10,2) NOT NULL,
    monto_pendiente DECIMAL(10,2) NOT NULL,
    fecha_vencimiento DATE NOT NULL,
    estado TEXT DEFAULT 'pendiente' CHECK(estado IN ('pendiente', 'parcial', 'pagada')),
    descripcion TEXT
);

-- Tabla de Recepciones
CREATE TABLE IF NOT EXISTS recepciones (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    almacen_id INTEGER NOT NULL,
    usuario_id INTEGER NOT NULL,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    tipo_recepcion TEXT CHECK(tipo_recepcion IN ('compra', 'transferencia', 'devolucion')) NOT NULL,
    estado TEXT DEFAULT 'pendiente' CHECK(estado IN ('pendiente', 'completada', 'cancelada')),
    notas TEXT,
    FOREIGN KEY (almacen_id) REFERENCES almacenes(id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- Tabla de Detalles de Recepciones
CREATE TABLE IF NOT EXISTS recepciones_detalle (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    recepcion_id INTEGER NOT NULL,
    producto_id INTEGER NOT NULL,
    cantidad INTEGER NOT NULL,
    precio_unitario DECIMAL(10,2),
    FOREIGN KEY (recepcion_id) REFERENCES recepciones(id),
    FOREIGN KEY (producto_id) REFERENCES productos(id)
);

-- Tabla de Cancelaciones
CREATE TABLE IF NOT EXISTS cancelaciones (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    tipo_operacion TEXT CHECK(tipo_operacion IN ('venta', 'transferencia', 'recepcion')) NOT NULL,
    operacion_id INTEGER NOT NULL,
    usuario_id INTEGER NOT NULL,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    motivo TEXT NOT NULL,
    estado TEXT DEFAULT 'pendiente' CHECK(estado IN ('pendiente', 'procesada', 'rechazada')),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- Eliminar usuario admin existente si existe
DELETE FROM usuarios WHERE username = 'admin';

-- Insertar usuario administrador por defecto
INSERT INTO usuarios (username, password, nombre, email, rol) 
VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrador', 'admin@itevo.com', 'admin');

-- Insertar algunas categorías de ejemplo
INSERT OR IGNORE INTO categorias (nombre, descripcion) VALUES 
('Electrónicos', 'Productos electrónicos y accesorios'),
('Oficina', 'Artículos de oficina'),
('Mobiliario', 'Muebles y equipamiento');

-- Insertar almacén de ejemplo
INSERT OR IGNORE INTO almacenes (nombre, ubicacion, responsable_id, capacidad) VALUES 
('Almacén Principal', 'Sede Central', 1, 1000);