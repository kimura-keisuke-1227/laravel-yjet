INSERT INTO columns (table_id, column_name, column_text_name, column_type)
SELECT
    t.id AS table_id,
    c.COLUMN_NAME AS column_name,
    c.COLUMN_NAME AS column_text_name,
    c.DATA_TYPE AS column_type
FROM
    tables t
JOIN
    INFORMATION_SCHEMA.COLUMNS c
ON
    c.TABLE_NAME = t.table_name
WHERE
    c.TABLE_SCHEMA = DATABASE()
    AND NOT EXISTS (
        SELECT 1
        FROM columns col
        WHERE col.table_id = t.id
        AND col.column_name = c.COLUMN_NAME
    );
