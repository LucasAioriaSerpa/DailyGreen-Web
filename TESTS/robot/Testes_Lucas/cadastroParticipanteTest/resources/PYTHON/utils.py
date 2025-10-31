import os; from robot.api.deco import keyword
@keyword("Absolute_path")
def Absolute_path(relative_path): return os.path.abspath(relative_path).replace("\\", "/")