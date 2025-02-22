<?php

class EmpresaModel
{
    public static function getEmpresaById(int $id)
    {
        $conn = Connection::getConn();

        try {
            $sql = "SELECT * FROM empresas WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $empresa = $stmt->fetchObject('EmpresaModel');

            if (!$empresa) {
                throw new Exception('Empresa não encontrada');
            }

            Connection::closeConn();
            return $empresa;
        } catch (PDOException $e) {
            Connection::closeConn();
            throw new Exception('Erro ao buscar empresa: ' . $e->getMessage());
        }
    }

    public static function getEmpresaLogoById(int $id)
    {
        $conn = Connection::getConn();

        try {
            $sql = "SELECT Logo FROM empresas WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $empresa = $stmt->fetchObject('EmpresaModel');

            if (!$empresa) {
                throw new Exception('Empresa não encontrada');
            }

            Connection::closeConn();
            return $empresa;
        } catch (PDOException $e) {
            Connection::closeConn();
            throw new Exception('Erro ao buscar empresa: ' . $e->getMessage());
        }
    }

    public static function getAllEmpresas()
    {
        $conn = Connection::getConn();

        try {
            $sql = "SELECT * FROM empresas ORDER BY id DESC";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $result = [];
            while ($row = $stmt->fetchObject('EmpresaModel')) {
                $result[] = $row;
            }

            if (empty($result)) {
                throw new Exception('Nenhum usuário encontrado');
            }

            Connection::closeConn();
            return $result;
        } catch (PDOException $e) {
            Connection::closeConn();
            throw new Exception('Erro ao buscar usuários: ' . $e->getMessage());
        }
    }
}
