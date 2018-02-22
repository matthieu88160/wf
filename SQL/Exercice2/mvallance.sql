SELECT agent_code FROM orders WHERE amount >= 1000;
SELECT agent_code, SUM(amount) FROM orders WHERE amount >= 1000 GROUP BY agent_code;
SELECT agent_code, SUM(amount), COUNT(id) FROM orders WHERE amount >= 1000 GROUP BY agent_code;
SELECT agent_code, SUM(amount), COUNT(id) FROM orders WHERE amount >= 1000 GROUP BY agent_code ORDER BY AVG(amount);
SELECT agent_code, SUM(amount), COUNT(id) FROM orders WHERE amount >= 1000 GROUP BY agent_code ORDER BY avg(amount) DESC;
