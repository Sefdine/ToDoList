USE todo_list;
CREATE TABLE todo_list(
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    status BOOLEAN DEFAULT FALSE,
    date_submit DATETIME NOT NULL
);

CREATE TABLE completed(
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    count INTEGER NOT NULL
);

DROP TRIGGER update_count_completed_add;
CREATE TRIGGER update_count_completed_add
AFTER UPDATE ON todo_list
FOR EACH ROW
BEGIN 
    IF NEW.status = 1 THEN
        UPDATE completed SET counts = counts + 1;
    END IF;
END;

DROP TRIGGER update_count_completed_drop;
CREATE TRIGGER update_count_completed_drop
AFTER UPDATE ON todo_list
FOR EACH ROW
BEGIN 
    IF NEW.status = 0 THEN
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

SELECT * FROM completed;

SELECT * FROM todo_list;

