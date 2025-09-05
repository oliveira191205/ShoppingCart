<?php 
class shoppingCart {
    private array $products;
    private array $carts;

    public function __construct() {
        $this->carts = [];
        $this->products = [
            ['id' => 1, 'nome' => "Geladeira Inox", 'preco' => 3500.00, 'estoque' => 5],
            ['id' => 2, 'nome' => "Fogão", 'preco' => 1000.00, 'estoque' => 10],
            ['id' => 3, 'nome' => "Smartphone", 'preco' => 2899.99, 'estoque' => 15],
            ['id' => 4, 'nome' => "Headphone", 'preco' => 189.00, 'estoque' => 2]
        ];
    }

    //LARISSA - verificar se o carrinho existe
    private function cartExist(int $idCart): bool {
        return $this->getCartById($idCart) !== null;
    }

    //MARCELA
    public function validateProduct(int $idProduct): bool|string {
        foreach ($this->products as $product) {
            if ($product['id'] === $idProduct) {
                return true;
            }
        }
        return $this->logError("Produto {$idProduct} não encontrado.");
    }

    //MARCELA
    public function validadeStock(int $idProduct, int $quantity): bool|string {
        $product = $this->getProductById($idProduct);
        if (!isset($product)) {
            return $this->logError("Produto não encontrado");
        }
        if ($quantity <= $product['estoque']) {
            return true;
        }
        return $this->logError("Quantidade insuficiente");
    }

    // LARISSA
    private function validateCartProduct(int $idProduct, int $idCart): bool {
        if (!$this->cartExist($idCart)) {
            return false;
        }

        foreach ($this->carts as &$cart) {
            if ($cart['id_carrinho'] === $idCart) {
                foreach ($cart['products'] as &$item) {
                    //se o item existe no carrinho, modifica a quantidade
                    if ($item['id_product'] === $idProduct) {
                        $item['quantity'] += 1;
                        $item['subtotal'] = $this->calculateSubtotal(
                            $this->getProductById($idProduct)['preco'], 
                            $item['quantity']
                        );
                        return true;
                    }
                }
                // se nao existe, adiciona o produto
                $cart['products'][] = [
                    'id_product' => $idProduct,
                    'quantity' => 1,
                    'subtotal' => $this->calculateSubtotal(
                        $this->getProductById($idProduct)['preco'], 1
                    )
                ];
                return true;
            }
        }
        return false;
    }

    // LARISSA
    public function removeProduct(int $idProduct, int $idCart): ?string {
        if (!$this->cartExist($idCart)) {
            return $this->logError("Erro: Carrinho {$idCart} não encontrado.");
        }

        foreach ($this->carts as &$cart) {
            if ($cart['id_carrinho'] === $idCart) {
                foreach ($cart['products'] as $index => $product) {
                    if ($product['id_product'] === $idProduct) {
                        $this->addStock($product['quantity'], $idProduct); //devolve para o estoque
                        unset($cart['products'][$index]); //remove do carrinho
                        return $this->logSuccess("O produto {$idProduct} foi removido do carrinho {$idCart}!");
                    }
                }
                return $this->logError("Erro: Produto {$idProduct} não está no carrinho {$idCart}.Product");
            }
        }
        return null;
    }

    // MARCELA 
    public function addStock(int $quantity, int $idProduct): ?string {
        foreach ($this->products as &$product) { // o & serve para pegar a referencia e atualizar o valor no array original
            if ($product['id'] === $idProduct) {
                $product['estoque'] += $quantity;
                return $this->logSuccess("Quantidade atualizada com sucesso " . $product['estoque']);
            }
        }
        return $this->logError("Verifique se o produto existe");
    }

    public function removeStock(int $quantity, int $idProduct): ?string {
        foreach ($this->products as &$product) {
            if ($product['id'] === $idProduct) {
                if ($quantity > $product['estoque']) {
                    return $this->logError("Quantidade insuficiente em estoque. Estoque atual: " . $product['estoque']);
                }
                $product['estoque'] = max(0, $product['estoque'] - $quantity);
                return $this->logSuccess("Quantidade atualizada com sucesso: " . $product['estoque']);
            }
        }
        return $this->logError("Verifique se o produto existe");
    }

    // LARISSA 
    public function calculateSubtotal(float $price, int $quantity): float {
        return $price * $quantity;
    }

    // MARCELA   
    public function calculateTotal(int $idCart): float {
        $total = 0;
        foreach ($this->carts as $cart) {
            if ($cart['id_carrinho'] === $idCart) {
                foreach ($cart['products'] as $product) {
                    $total += $product['subtotal'];
                }
            }
        }
        return $total;
    }

    // Desconto Fixo - 10% no valor total - MARCELA
    public function addDiscount(int $idCart): float {
        $totalCart = $this->calculateTotal($idCart);
        $discount = $totalCart * 0.10;
        return $totalCart - $discount;
    }

    // MARCELA
    public function addProduct(int $idCart, int $idProduct, int $quantity, float $subtotal) {
        if (!$this->cartExist($idCart)) {
            return $this->logError("Carrinho {$idCart} não encontrado.");
        }

        $validate = $this->validates($idProduct, $quantity);
        if ($validate != true) {
            return $validate;
        }

        foreach ($this->carts as &$cart) {
            if ($cart['id_carrinho'] === $idCart) {
                $cart['products'][] = [
                    'id_product' => $idProduct,
                    'quantity' => $quantity,
                    'subtotal' => $subtotal
                ];
                $this->removeStock($quantity, $idProduct);
                return $this->logSuccess("Produto {$idProduct} adicionado ao carrinho com sucesso.");
            }
        }
    }

    public function createCart(int $idProduct, int $quantity, float $subtotal) {
        $newCartId = count($this->carts) + 1;
        $this->carts[] = [
            'id_carrinho' => $newCartId,
            'products' => [
                [
                    'id_product' => $idProduct,
                    'quantity' => $quantity,
                    'subtotal' => $subtotal
                ]
            ]
        ];
        return $this->logSuccess("Carrinho criado com ID {$newCartId}.");
    }

    // LARISSA
    private function getProductById(int $idProduct): ?array {
        foreach ($this->products as $product) {
            if ($product['id'] === $idProduct) {
                return $product;
            }
        }
        return null;
    }

    private function getCartById(int $idCart): ?array {
        foreach ($this->carts as $cart) {
            if ($cart['id_carrinho'] === $idCart) {
                return $cart;
            }
        }
        return null;
    }

    // LARISSA
    public function listCartProducts(int $idCart): string {
        $cart = $this->getCartById($idCart);
        if ($cart === null) {
            return $this->logError("Carrinho {$idCart} não encontrado.");
        }
        if (empty($cart['products'])) {
            return $this->logError("O carrinho {$idCart} está vazio.");
        }
        $list = "Produtos do carrinho {$idCart}:\n";
        foreach ($cart['products'] as $product) {
            $productInfo = $this->getProductById($product['id_product']);
            $list .= "Produto: {$productInfo['nome']} | ";
            $list .= "Quantidade: {$product['quantity']} | ";
            $list .= "Subtotal: R$ " . number_format($product['subtotal'], 2, ',', '.') . "\n";
        }
        return $list;
    }

    // MARCELA
    public function validates(int $idProduct, int $quantity): bool|string {
        $product = $this->getProductById($idProduct);
        if (!isset($product)) {
            return $this->logError("Produto não encontrado");
        }
        $stockValidate = $this->validadeStock($idProduct, $quantity);
        if ($stockValidate != true) return $stockValidate;
        return true;
    }

    // MARCELA 
    public function logSuccess(string $message, string $context = ""): string {
        $this->log("Sucesso", $message, $context);
        return $message;
    }

    public function logError(string $message, string $context = ""): string {
        $this->log("Erro", $message, $context);
        return $message;
    }

    public function log(string $type, string $message, string $context = ""): void {
        $logMessage = "{$type}: {$message}";
        if (!empty($context)) {
            $logMessage .= " | Contexto: {$context}";
        }
    }
}
