local Object = {}

function table.copy(table)
  local newtable = {}
  for key, value in pairs(table) do newtable[key] = value end
  return newtable
end

-- Class Meta Table
Object.__meta = {}
 
function Object.__meta.__index(table, key)
  local super = rawget(table, 'super')
  return super and key and super[key] or nil
end

function Object.__meta.__call(table, ...)
  local super = rawget(table, 'super')
  return table:__init(...) or super and super:__init(...) or nil
end
--/Class Meta Table

-- Returns a class that is a child of self
function Object:extend()
  local class = {}
  class.super = self
  class.__meta = table.copy(self.__meta)
  return setmetatable(class, class.__meta)
end

--Constructor
function Object:__init()
  local newobject = self.super and self.super:__init() or {}
  newobject.super = self.super
  newobject.static = self
  newobject.__meta = {}
  
  -- Instance Meta Table
  function Object.__meta.__index(table, key)
    local static = rawget(table, 'static')
    return static and key and static[key] or nil
  end
  --/Instance Meta Table

  function newobject:tostring()
    return "::object::"
  end
  
  function newobject:instanceof(class)
    local static = self.static
    while static do
      if static == class then
        return true
      else
        static = static.super
      end
    end
    return false
  end

  return setmetatable(newobject, self.__meta)
end

return setmetatable(Object, Object.__meta)
