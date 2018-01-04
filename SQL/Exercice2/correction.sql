SELECT agent_code, SUM(amount) as sales_amount, COUNT(id) as order_count 
	FROM ORDERS 
	WHERE amount >= 1000
    GROUP BY agent_code
    ORDER BY AVG(amount) DESC;
