UPDATE ORDERS SET description = "NC" WHERE agent_code = "A002";

DELETE FROM ORDERS WHERE customer_code = "C00022" AND description = "NC";
