
-- ملف: installer/schema.sql
-- جداول نظام الموارد البشرية

CREATE TABLE admins
(
    id INT
    AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR
    (100) NOT NULL,
    password VARCHAR
    (255) NOT NULL,
    role VARCHAR
    (50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

    CREATE TABLE branches
    (
        id INT
        AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR
        (255) NOT NULL,
    location VARCHAR
        (255),
    status TINYINT DEFAULT 1
);

        CREATE TABLE employees
        (
            id INT
            AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR
            (255) NOT NULL,
    email VARCHAR
            (255),
    phone VARCHAR
            (20),
    branch_id INT,
    hire_date DATE,
    job_title VARCHAR
            (100),
    status TINYINT DEFAULT 1,
    FOREIGN KEY
            (branch_id) REFERENCES branches
            (id)
);

            CREATE TABLE attendance
            (
                id INT
                AUTO_INCREMENT PRIMARY KEY,
    employee_id INT,
    date DATE,
    check_in TIME,
    check_out TIME,
    status ENUM
                ('present', 'absent', 'late') DEFAULT 'present',
    FOREIGN KEY
                (employee_id) REFERENCES employees
                (id)
);

                CREATE TABLE shifts
                (
                    id INT
                    AUTO_INCREMENT PRIMARY KEY,
    branch_id INT,
    shift_name VARCHAR
                    (100),
    start_time TIME,
    end_time TIME,
    notes TEXT,
    FOREIGN KEY
                    (branch_id) REFERENCES branches
                    (id)
);

                    CREATE TABLE leaves
                    (
                        id INT
                        AUTO_INCREMENT PRIMARY KEY,
    employee_id INT,
    leave_type VARCHAR
                        (100),
    start_date DATE,
    end_date DATE,
    reason TEXT,
    status ENUM
                        ('pending', 'approved', 'rejected') DEFAULT 'pending',
    FOREIGN KEY
                        (employee_id) REFERENCES employees
                        (id)
);

                        CREATE TABLE salaries
                        (
                            id INT
                            AUTO_INCREMENT PRIMARY KEY,
    employee_id INT,
    month_year VARCHAR
                            (10),
    base_salary DECIMAL
                            (10,2),
    bonus DECIMAL
                            (10,2),
    deductions DECIMAL
                            (10,2),
    final_salary DECIMAL
                            (10,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY
                            (employee_id) REFERENCES employees
                            (id)
);

                            CREATE TABLE tasks
                            (
                                id INT
                                AUTO_INCREMENT PRIMARY KEY,
    employee_id INT,
    task_title VARCHAR
                                (255),
    description TEXT,
    deadline DATE,
    status ENUM
                                ('pending', 'completed', 'overdue') DEFAULT 'pending',
    FOREIGN KEY
                                (employee_id) REFERENCES employees
                                (id)
);

                                CREATE TABLE rewards
                                (
                                    id INT
                                    AUTO_INCREMENT PRIMARY KEY,
    employee_id INT,
    reward_type VARCHAR
                                    (100),
    value DECIMAL
                                    (10,2),
    reason TEXT,
    date DATE,
    FOREIGN KEY
                                    (employee_id) REFERENCES employees
                                    (id)
);

                                    CREATE TABLE penalties
                                    (
                                        id INT
                                        AUTO_INCREMENT PRIMARY KEY,
    employee_id INT,
    penalty_type VARCHAR
                                        (100),
    value DECIMAL
                                        (10,2),
    reason TEXT,
    date DATE,
    FOREIGN KEY
                                        (employee_id) REFERENCES employees
                                        (id)
);

                                        CREATE TABLE notifications
                                        (
                                            id INT
                                            AUTO_INCREMENT PRIMARY KEY,
    employee_id INT,
    title VARCHAR
                                            (255),
    message TEXT,
    is_read TINYINT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY
                                            (employee_id) REFERENCES employees
                                            (id)
);

                                            CREATE TABLE documents
                                            (
                                                id INT
                                                AUTO_INCREMENT PRIMARY KEY,
    employee_id INT,
    file_name VARCHAR
                                                (255),
    file_path VARCHAR
                                                (255),
    uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY
                                                (employee_id) REFERENCES employees
                                                (id)
);
