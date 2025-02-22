<?php

class AdminModel
{
    public static function getAllLogs()
    {
        $conn = Connection::getConn();

        try {
            $sql = "SELECT l.*,
                        u.Nome AS ResponsavelNome,
                        e.Nome AS CompanyName
                    FROM mainlog AS l
                        LEFT JOIN empresas AS e ON l.CompanyId = e.Id
                        LEFT JOIN users AS u ON l.UserId = u.Id
                    ORDER BY l.Id DESC";

            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $logs = [];
            while ($row = $stmt->fetchObject('AdminModel')) {
                $logs[] = $row;
            }

            Connection::closeConn();

            return $logs;

        } catch (PDOException $e) {
            Connection::closeConn();
            throw new Exception('Erro ao buscar logs: ' . $e->getMessage());
        }
    }

    public static function getAllOrcamentos() {

        $conn = Connection::getConn();

        try {
            $sql = "SELECT o.*,
                        u.Nome AS ResponsavelNome,
                        c.Nome AS CustomerName,
                        e.Endereco AS CompanyAddress,
                        e.Telefone AS CompanyPhone,
                        e.Nome AS CompanyName
                    FROM orcamentos AS o 
                        LEFT JOIN clientes AS c ON o.CustomerId = c.Id 
                        LEFT JOIN empresas AS e ON o.CompanyId = e.Id 
                        LEFT JOIN users AS u ON o.ResponsavelId = u.Id
                    WHERE c.Id IS NOT NULL 
                    ORDER BY o.Id DESC;";
                    
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $orcamentos = [];
            while ($row = $stmt->fetchObject('AdminModel')) {
                $orcamentos[] = $row;
            }

            if (!$orcamentos) {
                throw new Exception('Orçamento não encontrado');
            }

            Connection::closeConn();
            
            return $orcamentos;

        } catch (PDOException $e) {
            Connection::closeConn();
            throw new Exception('Erro ao buscar orçamentos: ' . $e->getMessage());
        }
    }
}
