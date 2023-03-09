USE todo_list;
CREATE TABLE todo_list(
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    status BOOLEAN DEFAULT FALSE,
    date_submit DATETIME NOT NULL
);

ALTER TABLE todo_list CHANGE date_submit date_submit DATETIME DEFAULT NOW();

CREATE TABLE completed(
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    count INTEGER NOT NULL
);

DROP TRIGGER update_count_completed_add;
CREATE TRIGGER update_count_completed_add
AFTER UPDATE ON todo_list
FOR EACH ROW
BEGIN 
    IF NEW.status = 1 AND OLD.status != NEW.status THEN
        UPDATE completed SET counts = counts + 1;
    END IF;
END;

DROP TRIGGER update_count_completed_drop;
CREATE TRIGGER update_count_completed_drop
AFTER UPDATE ON todo_list
FOR EACH ROW
BEGIN 
    IF NEW.status = 0 AND OLD.status != NEW.status THEN
        UPDATE completed SET counts = counts - 1;
    END IF;
END;

DROP TRIGGER delete_count_completed_drop;
CREATE TRIGGER delete_count_completed_drop
AFTER DELETE ON todo_list
FOR EACH ROW
BEGIN 
    IF OLD.status = 1 THEN 
        UPDATE completed SET counts = counts - 1;
    END IF;
END;

DROP TRIGGER update_date_submit;
CREATE TRIGGER update_date_submit
AFTER UPDATE ON todo_list
FOR EACH ROW
BEGIN
    IF (OLD.title != NEW.title OR OLD.description != NEW.description) AND OLD.status = NEW.status THEN
        UPDATE todo_list SET date_submit = NOW() WHERE id = NEW.id;
    END IF;
END;


SELECT * FROM completed;

UPDATE completed SET counts = 0;

SELECT * FROM todo_list;

SHOW VARIABLES LIKE 'log_error';

UPDATE todo_list SET title = 'New Title', description = 'New Description', date_submit = NOW() WHERE id = 43;
