CREATE TABLE IF NOT EXISTS wards (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    floor TEXT NULL,
    building TEXT NULL
);

CREATE TABLE IF NOT EXISTS beds (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    ward_id INTEGER NOT NULL,
    code TEXT NOT NULL,
    status TEXT NOT NULL,
    notes TEXT NULL,

    FOREIGN KEY (ward_id) REFERENCES wards(id),

    UNIQUE (ward_id, code),

    CHECK (
        status IN (
            'disponible',
            'ocupada',
            'limpieza',
            'mantenimiento'
        )
    )
);