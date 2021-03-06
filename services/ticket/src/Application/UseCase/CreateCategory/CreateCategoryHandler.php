<?php
declare(strict_types=1);

namespace Ticket\Application\UseCase\CreateCategory;

use Ticket\Application\Exception\PermissionException;
use Ticket\Domain\Category\Category;
use Ticket\Domain\Category\CategoryName;
use Ticket\Domain\Category\CategoryPermissionService;
use Ticket\Domain\Category\CategoryRepository;

class CreateCategoryHandler
{
    private CategoryRepository $categoryRepository;
    private CategoryPermissionService $categoryPermissionService;

    public function __construct(
        CategoryRepository $categoryRepository,
        CategoryPermissionService $categoryPermissionService
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->categoryPermissionService = $categoryPermissionService;
    }

    /**
     * @param CreateCategoryCommand $command
     * @throws PermissionException
     */
    public function handle(CreateCategoryCommand $command): void
    {
        $user = $command->author();
        if (!$this->categoryPermissionService->canUserManageCategory($user)) {
            throw PermissionException::withMessage('User cannot create new category.');
        }

        $category = new Category(
            $this->categoryRepository->nextIdentity(),
            new CategoryName($command->name())
        );
        $this->categoryRepository->add($category);
    }
}