USE todo_list;
CREATE TABLE todo_list(
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    status BOOLEAN DEFAULT FALSE,
    date_submit DATETIME NOT NULL
);
SELECT * FROM todo_list;
