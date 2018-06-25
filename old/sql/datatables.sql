CREATE OR REPLACE VIEW foto_count AS SELECT count(id) AS cnt, id_album FROM foto GROUP BY id_album;
CREATE OR REPLACE VIEW datatables AS SELECT * FROM album LEFT JOIN foto_count ON album.id = foto_count.id_album;
